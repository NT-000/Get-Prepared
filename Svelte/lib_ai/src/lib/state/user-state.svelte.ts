import type {Session, SupabaseClient, User} from "@supabase/supabase-js";
import {getContext, setContext} from "svelte";
import {goto} from "$app/navigation";
import type {Database} from "$lib/types/database.types";


interface UserStateProps {
    session: Session | null;
    supabase: SupabaseClient | null;
    user: User | null;
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

    async logout() {
        await this.supabase?.auth.signOut();
        await goto("/login");
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
}

const USER_STATE_KEY = Symbol("USER_STATE");

export function setUserState(data: UserStateProps) {
    return setContext(USER_STATE_KEY, new UserState(data));
}

export function getUserState() {
    return getContext<ReturnType<typeof setUserState>>(USER_STATE_KEY);
}