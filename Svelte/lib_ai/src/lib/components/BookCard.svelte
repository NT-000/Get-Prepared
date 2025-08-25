<script lang="ts">
    import type {Book} from "$lib/state/user-state.svelte";
    import Icon from "@iconify/svelte";

    interface BookProps {
        book: Book,
    }

    let {book}: BookProps = $props();

    function convertToLocalString(date: string) {
        const newDate = new Date(date);
        return newDate.toLocaleDateString("no-NO", {
            weekday: "short",
            year: "numeric",
            month: "long",
            day: "2-digit",
        })
    }

    function convertStars(book: Book) {
        let html = "";
        $inspect(book.rating)
        for (let i = 0; i < (book?.rating ?? 0); i++) {

            html += `<Icon icon="famicons:star-sharp"/>`;
        }
        return html;
    }

    let bookStatus = $derived(
        book.finished_read ? "Finished" : book.started_reading ? "Currently reading" : "Not started"
    )
</script>

<div class={book.finished_read ? "read" : "notRead"}>
    <a class="book-card mb-s" href={`/private/books/${book.id}`}>
        {#if book.cover_img}
            <img src="{book.cover_img}" alt="cover">
        {/if}
        <h2>Title: {book.title}</h2>
        <h3>Author: {book.author}</h3>
        <h3>Genre: {book.genre}</h3>
        <h3>Description:</h3>

        <div class="rating mt-s">
            Rating:
            {#each Array(book.rating) as i}
                <Icon icon="famicons:star-sharp"/>
            {/each}
            {#each Array(5 - (book?.rating ?? 0)) as i}
                <Icon icon="famicons:star-outline"/>
            {/each}
        </div>


        <h4>Status: {bookStatus}
            <Icon icon="famicons:eye"/>
        </h4>

        <p>Date added: {convertToLocalString(book.created_at)}</p>
    </a>
</div>

<style>
    .book-card {
        display: flex;
        flex-direction: column;

    }

    a {
        text-decoration: none;
    }

    a:hover {
        opacity: 0.7;
        text-decoration: none;
    }

    .read {

    }

    .rating {
        display: flex;
    }
</style>