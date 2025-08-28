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
    <h3>{categoryName}</h3>
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
    }
</style>