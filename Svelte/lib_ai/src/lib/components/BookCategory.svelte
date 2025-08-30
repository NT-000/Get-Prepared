<script lang="ts">

    import type {Book} from "$lib/state/user-state.svelte";
    import {BookCard} from "$components/index";

    interface BookCategoryProps {
        categoryName: string,
        booksToDisplay: Book[],
    }

    let {categoryName, booksToDisplay}: BookCategoryProps = $props();
</script>

<section class="book-category mb-m">
    <h3 class="cat-name">{categoryName}</h3>
    <div class="book-container">
        {#each booksToDisplay as book}
            <BookCard {book}/>
        {/each}
    </div>
</section>

<style>
    .book-container {
        display: flex;
        overflow-x: auto;
        gap: 16px;
        padding-bottom: 8px;
        scroll-behavior: smooth;
        scrollbar-width: thin;
    }

    .cat-name {
        padding: 4px;
        border-bottom: grey solid 3px;
        border-radius: 1px;
        width: 70%;
        margin-bottom: 10px;
    }

    .books-container::-webkit-scrollbar {
        height: 8px;
    }

    .books-container::-webkit-scrollbar-thumb:hover {
        background-color: rgba(0, 0, 0, 0.3);
        border-radius: 3px;
    }
</style>