import type {Book} from "$lib/state/user-state.svelte";

export function calculateDaysPast(book: Book) {

    let start = new Date(book.started_reading).getTime();
    let end = new Date(book.finished_read).getTime();

    let days = ((end - start) / (1000 * 60 * 60 * 24));

    console.log("book start:", book.started_reading)

    return days;
}