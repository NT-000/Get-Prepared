<script lang="ts">
    import type {Book} from "$lib/state/user-state.svelte";
    import Icon from "@iconify/svelte";
    import StarRating from "$components/StarRating.svelte";
    import {calculateDaysPast, convertToLocalString} from "$components/helperFunctions/helpers";

    interface BookProps {
        book: Book,
    }

    let {book}: BookProps = $props();


    let bookStatus = $derived(
        book.finished_read ? "Read" : book.started_reading ? "Currently reading" : "Not started"
    )


</script>

<div class={book.finished_read ? "read" : "notRead"}>
    <a class="book-card mb-s" href={`/private/books/${book.id}`}>
        <div class="book-cover">
            {#if book.cover_img}
                <img src="{book.cover_img}" alt="cover">
            {/if}
        </div>
        <h4>{bookStatus}
            {#if book.finished_read}
                in {calculateDaysPast(book)} Days
            {/if}
            <Icon icon="famicons:eye"/>
        </h4>
        <div class="book-info">
            <h3>{book.title}</h3>
            <h3>{book.author}</h3>
            <StarRating {book}/>
            <p>Date added: {convertToLocalString(book.created_at)}</p>
            {#if book.started_reading}
                <p>Date started reading: {convertToLocalString(book.started_reading)}</p>
            {/if}
            {#if book.finished_read}
                <p>Date finished book: {convertToLocalString(book.finished_read)}</p>
            {/if}
        </div>
    </a>
</div>

<style>
    .book-card {
        position: relative;
        display: flex;
        flex-direction: column;
        width: 100%;
        min-width: 360px;
        
        max-width: 450px;
        height: 320px;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        text-decoration: none;
        text-align: left;
        color: white;
    }

    .book-info:last-of-type {
        padding-bottom: 20px;
    }

    .book-info {
        background: rgba(0, 0, 0, 0.4);
        height: 100%;
        width: 100%;
        padding: 60px 16px 5px 16px;
        border-radius: 12px;
    }

    .book-cover {
        position: absolute;
        width: 100%;
        height: 100%;
        z-index: -1;
    }

    .book-cover img {
        position: absolute;
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 10px;
    }

    .days-counter {
        position: absolute;
        top: 0;
        left: 0;
        color: gold;
        padding: 16px;
    }


    a {
        text-decoration: none;
    }

    a:hover {
        opacity: 0.7;
        text-decoration: none;
    }

    .book-info p {
        font-size: 14px;
        font-family: "Winky Sans", sans-serif;
        font-style: italic;
    }


    h4 {
        position: absolute;
        right: 20px;
        top: 20px;
        padding: 4px 8px;
        width: auto;
        background-color: rgb(0, 180, 253);
        opacity: 0.6;
        border-radius: 10px;
    }


</style>