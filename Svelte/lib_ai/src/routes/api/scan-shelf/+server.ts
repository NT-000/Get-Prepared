import {json, type RequestHandler} from "@sveltejs/kit";
import OpenAI from "openai";
import {OPEN_AI_KEY, GOOGLE_BOOKS_API_KEY} from "$env/static/private";
import type {Book} from "$lib/state/user-state.svelte";


const openai = new OpenAI({
    apiKey: OPEN_AI_KEY,
});

export const POST: RequestHandler = async ({request}) => {


    const {base64} = await request.json()


    const response = await openai.responses.create({

        model: "gpt-5",
        input: [
            {
                role: "user",
                content: [
                    {
                        type: "input_text",
                        text: `Extract books from the image provided and return them as JSON. What I need is the information in this format: 
                        {
                        "title": "Thinking, Fast and Slow",
                        "author": "Daniel Kahneman",
                        "description": "A book about human decision-making and the two systems in the brain.",
                        "genre": "Psychology",
                        "yearPublished": 2011,
                        "isbn":  9780141033570
                        }
                        Please also make sure you return an array, even if there is only one book visible on the image.
                        If spine is rotated, read and normalize.
                        If book is of another language and available in english, translate keys and values to english - if not available in english, leave it as is.`,
                    },
                    {
                        type: "input_image",
                        image_url: `data:image/jpeg;base64,${base64}`,
                        detail: "high"
                    },
                ],
            },
        ],
    });

    const booksArrayString = response.output_text.replace(/```json|```/g, "").trim();
    const bookArray = JSON.parse(booksArrayString || "")

    async function complementOpenABookResponse(book: Book) {

        let url: string;

        if (book.isbn) {
            url = `https://www.googleapis.com/books/v1/volumes?q=isbn:${book.isbn}&key=${GOOGLE_BOOKS_API_KEY}`;
        } else {
            const qParts = [];
            if (book.title) qParts.push(`intitle:${book.title}`)
            if (book.author) qParts.push(`inauthor:${book.author}`)
            const q = qParts.length ? qParts.join("+") : (book.title ?? "");

            url = `https://www.googleapis.com/books/v1/volumes?q=${q || (book.title ?? "")}&key=${GOOGLE_BOOKS_API_KEY}`;

            const res = await fetch(url)
            if (!res.ok) return book;
            const data = await res.json()

            const item = data?.items?.[0]
            if (!item.volumeInfo) return book;

            return {
                ...book,
                title: item.volumeInfo.title || book.title,
                author: item.volumeInfo.author || book.author,
                description: item.volumeInfo.description || book.description,
                genre: book.genre,
                yearPublished: book.yearPublished ?? (item.volumeInfo.yearPublished.publishedDate ?? null),
                cover_img: item.volumeInfo.imageLinks?.thumbnail ?? item.volumeInfo.imageLinks.thumbnail
            }
        }
    }

    const booksEditedFromApi = []

    for (let book of bookArray) {
        try {
            booksEditedFromApi.push(await complementOpenABookResponse(book))
            console.log("Book from api:", book)
        } catch (error) {
            booksEditedFromApi.push(book)
        }
    }

    console.log("BookArray, before checking:", bookArray)
    console.log("After check:", booksEditedFromApi)

    return json({success: true, booksEditedFromApi});
}