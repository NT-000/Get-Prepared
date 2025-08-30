import type {Book} from "$lib/state/user-state.svelte";

export function calculateDaysPast(book: Book) {

    if (!book.started_reading || !book.finished_read) {
        return null;
    }
    let start = new Date(book.started_reading).getTime();
    let end = new Date(book.finished_read).getTime();

    let days = ((end - start) / (1000 * 60 * 60 * 24));

    console.log("book start:", book.started_reading)

    return days;
}

export function convertToLocalString(date: string) {
    const newDate = new Date(date);
    return newDate.toLocaleDateString(navigator.language, {
        weekday: "short",
        year: "numeric",
        month: "long",
        day: "2-digit",
    })
}