import type {Session, SupabaseClient, User} from "@supabase/supabase-js";
import {getContext, setContext} from "svelte";
import {goto, invalidate, invalidateAll} from "$app/navigation";
import type {Database} from "$lib/types/database.types";

import {uuid} from "@supabase/supabase-js/dist/main/lib/helpers";


interface UserStateProps {
    session: Session | null;
    supabase: SupabaseClient | null;
    user: User | null;
}

export interface OpenAiBook {
    bookTitle: string,
    author: string,
    description: string,
    genre: string,
}

export interface BookProfile {
    id: number,
    title: string | null,
    author: string | null,
    cover_img: string | null,
    rating: number | null,
    started_reading: string | null,
    finished_read: string | null,
}

export interface Book {
    author: string | null
    cover_img: string | null
    created_at: string
    description: string | null
    finished_read: string | null
    genre: string | null
    id: number
    rating: number | null
    started_reading: string | null
    title: string
    user_id: string
    isbn: string | null
    yearPublished?: number | null
}

export class UserState {
    session = $state<Session | null>(null);
    supabase = $state<SupabaseClient<Database> | null>(null);
    user = $state<User | null>(null);
    userBooks = $state<Book[]>([]);
    userName = $state<string | null>(null);

    constructor(data: UserStateProps) {
        this.updateState(data);
    }

    updateState(data: UserStateProps) {
        this.session = data.session;
        this.supabase = data.supabase;
        this.user = data.user;
        this.fetchUserData();
    }

    async fetchUserData() {
        if (!this.user || !this.supabase) {
            return;
        }

        const [booksResponse, userNamesResponse] = await Promise.all([
            this.supabase.from("books").select("*").eq("user_id", this.user?.id),
            this.supabase.from("user_names").select("name").eq("user_id", this.user?.id).single(),
        ])

        if (booksResponse.error || !booksResponse.data || userNamesResponse.error || !userNamesResponse.data) {
            console.error(booksResponse.error);
            console.error(userNamesResponse.error);
            return;
        }

        this.userBooks = booksResponse.data;
        this.userName = userNamesResponse.data.name;
    }


    async fetchSearchQueryForUsers(search: string) {
        if (!this.supabase) {
            return;
        }
        const {
            data,
            error
        } = await this.supabase.from("user_names").select("user_id, name").ilike("name", `%${search}%`);
        if (error) {
            console.error(error);
            return [];
        }

        console.log("data query usernames", data[0].name);

        return data ?? [];
    }

    fetchBookByGenreSortedByRating(searchGenre: string) {
        return this.userBooks.filter(book => book.genre === searchGenre).toSorted((a, b) => (b.rating ?? 0) - (a.rating ?? 0))
    }

    fetchUnreadBooks(): Book[] {

        return this.userBooks.filter(b => !b.started_reading).toSorted((a, b) => new Date(a.created_at).getTime() - new Date(b.created_at).getTime())
    }

    fetchCurrentlyReading(): Book[] {
        return this.userBooks.filter(b => b.started_reading && !b.finished_read).toSorted((a, b) => new Date(a.created_at).getTime() - new Date(b.created_at).getTime())
    }

    fetchFavoriteBooks(): Book[] {

        return this.userBooks.filter(b => b.rating).toSorted((a, b) => (b.rating ?? 0) - (a.rating ?? 0)).slice(0, 5)
    }

    fetchFinishedBook(): Book[] {
        $inspect("logg ferdig bøker:", this.userBooks.map(b => b.finished_read))
        return this.userBooks.filter(b => b.finished_read).toSorted((a, b) => new Date(b.finished_read!).getTime() - new Date(a.finished_read!).getTime())
    }

    //POST

    async uploadImageCover(file: File, bookId: number): Promise<void> {
        if (!this.user || !this.supabase || !file) {
            return;
        }

        const filePath = `${this.user.id}/${uuid()}_${file.name}`;
        const {error: uploadError} = await this.supabase.storage.from("book-covers").upload(filePath, file)

        if (uploadError) {
            return console.error(uploadError);
        }

        const {data: {publicUrl}} = this.supabase.storage.from("book-covers").getPublicUrl(filePath)

        await this.updateBook({id: bookId, cover_img: publicUrl});
    }

    async addBooksToLibrary(books: Book[]) {
        if (!this.supabase || !this.user) return;
        const userId = this.user.id;
        const newBooks = books.map(book => ({
            title: book.title,
            author: book.author,
            description: book.description,
            genre: book.genre,
            cover_img: book.cover_img,
            user_id: userId,
        }))

        const {error} = await this.supabase.from("books").insert(newBooks)

        if (error) throw new Error(error.message);
        else {
            await this.fetchUserData();
        }
    }

    async updateUserInfo(email: string, userName: string) {
        if (!this.session) return;
        try {
            const response = await fetch("/api/update-account", {
                method: "PATCH",
                headers: {
                    "Content-Type": "application/json",
                    Authorization: `Bearer ${this.session.access_token}`,
                },
                body: JSON.stringify({email, userName}),
            })
            if (response.ok) {
                this.userName = userName;
            }
        } catch (error) {
            console.error("failed to update account", error);
        }
    }

    async deleteUser() {
        if (!this.session) return;
        try {
            const response = await fetch("/api/delete-account", {
                method: "DELETE",
                headers: {
                    "Content-Type": "application/json",
                    Authorization: `Bearer ${this.session.access_token}`,
                }
            })
            if (response.ok) {
                console.log("deleted account")
                await this.logout()
                await goto("/")
            }


        } catch (error) {
            console.error("failed to delete account", error);
        }

    }

    async logout() {
        await this.supabase?.auth.signOut();
        await goto("/login");
    }

    // UPDATE
    async updateBookRating(bookRating: number, book: Book) {
        await this.supabase?.from("books").update({rating: bookRating}).eq("id", book.id).single()
    }

    async updateBook(book: Partial<Book> & { id: number }) {

        const {id, ...rest} = book;
        console.log("book updateBook, userContext", rest);
        await this.supabase?.from("books").update(rest).eq("id", id)
        await invalidateAll()
    }

    // DELETE

    async deleteBook(book: Book) {
        if (!this.supabase) return;

        const {error, status} = await this.supabase?.from("books").delete().eq("id", book.id).single()
        if (!error && status === 204) {
            this.userBooks = this.userBooks.filter(book => book.id !== book.id)
            await goto("private/dashboard")
        }
    }

    fetchFavoriteGenre() {
        const genreCounts: { [key: string]: number } = {};

        if (this.userBooks.filter((book) => book.genre).length === 0) {
            return "";
        }
        this.userBooks.forEach(book => {
            const genre = book.genre;
            if (genre) {
                if (!genreCounts[genre]) {
                    genreCounts[genre] = 1;
                } else {
                    genreCounts[genre]++;
                }
            }
        })
        console.log("genrecounts:", genreCounts);
        const mostCommonBooks = Object.keys(genreCounts).reduce((a, b) => genreCounts[a] > genreCounts[b] ? a : b)
        return mostCommonBooks || null;
    }
}

const USER_STATE_KEY = Symbol("USER_STATE");

export function setUserState(data: UserStateProps) {
    return setContext(USER_STATE_KEY, new UserState(data));
}

export function getUserState() {
    return getContext<ReturnType<typeof setUserState>>(USER_STATE_KEY);
}