<script lang="ts">
    import type {Book} from "$lib/state/user-state.svelte";
    import PickRating from "$components/PickRating.svelte";
    import {Button, StarRating} from "$components";
    import Icon from "@iconify/svelte";

    interface BookPageBookProps {
        data: {
            book: Book
        }
    }

    let isEdit = $state(false);

    let {data}: BookPageBookProps = $props();
    let book = $derived(data.book)
</script>

<section>
    <h2 class="book-title mt-m">{book.title}</h2>
    {#if book.cover_img}
        <img src="{book.cover_img}" alt="cover">
    {:else if !book.cover_img && isEdit}
        <button>

            <span class="add-image">Add cover image
            <span class="icon-wrapper">
                <Icon class="icon" icon="bi:camera-fill"/>
            </span>
            </span>
        </button>
    {/if}
    <p class="mt-m mb-s semi-bold">{book.author}</p>
    <h4 class="mt-m mb-xs semi-bold">Your rating</h4>

    {#if isEdit}

        <PickRating value={book.rating ?? 0} {book}/>

    {:else}
        <StarRating {book}/>
    {/if}

    {#if book.description}
        <h4 class="book-description italic mt-m mb-xs semi-bold">{book.description}</h4>
    {:else}
        <h4 class="italic mt-m mb-xs semi-bold">No description.</h4>
        <Button isSecondary={true}
                onclick={() => console.log("clicked it")}><p>Add a description for the book</p>
        </Button>
    {/if}
    {#if !book.finished_read && isEdit}
        <Button isSecondary={true}
                onclick={() => console.log("clicked it")}>{book.started_reading ? "I finished reading this book!" : "Start reading this book"}</Button>
    {/if}
    {#if book.genre}
        <h4 class="mt-m mb-xs semi-bold">Genre</h4>
        <p>{book.genre}</p>
    {/if}


    <Button onclick={() => isEdit = !isEdit}>
        {!isEdit ? "Edit page" : "Save page"}
    </Button>

</section>

<style>


    img {
        max-width: 20%;
        min-width: 20%;
        min-height: 400px;
        max-height: 600px;
        border-radius: 15px;
        border: 15px solid black;
    }

    .icon-wrapper {
        display: inline-flex;
        padding: 5px;
        font-size: 30px;
        transition: transform 0.2s ease, filter 0.2s ease;
    }

    .add-image {
        font-size: 23px;
        font-weight: bold;
    }

    .add-image:hover .icon-wrapper {
        transform: scale(1.3);
    }

    .icon-wrapper:hover {
        font-weight: bold;
        transform: scale(1.3);
    }
</style>