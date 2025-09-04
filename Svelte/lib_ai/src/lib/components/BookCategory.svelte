<script lang="ts">

    import {type Book, getUserState} from "$lib/state/user-state.svelte";
    import {BookCard, Button} from "$components/index";
    import Icon from "@iconify/svelte";

    interface BookCategoryProps {
        categoryName: string,
        booksToDisplay: Book[],
    }

    let {categoryName, booksToDisplay}: BookCategoryProps = $props();
    let userContext = getUserState();

    function handleRefresh() {
    }
</script>

<section class="book-category mb-m">
    {#if categoryName === "Random books"}
        <h3 class="cat-name">
            <span>{categoryName}
                <Button type="button" onclick={() => handleRefresh()} isIcon={true}>
                    <Icon icon="material-symbols:frame-reload" class="refresh-random"/>
                </Button>
            </span>
        </h3>
    {:else}
        <h3>{categoryName}</h3>
    {/if}
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

    :global(.refresh-random) {
        background-color: transparent;
    }
</style>