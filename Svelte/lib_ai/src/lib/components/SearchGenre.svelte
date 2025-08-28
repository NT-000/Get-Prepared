<script lang="ts">

    import type {Book} from "$lib/state/user-state.svelte";
    import {BookCategory, Button} from "$components/index";
    import convertToLocalString from "$components/BookCard.svelte"

    interface SearchProps {
        searchGenre: string,
        books: Book[],
    }

    type Category = { id: number, name: string }

    let categories: Category[] = [
        {id: 1, name: "Classic"},
        {id: 2, name: "History"},
        {id: 3, name: "Fantasy"},
        {id: 4, name: "Psychology"},
        {id: 5, name: "Dystopia"},
        {id: 6, name: "Fiction"},
        {id: 7, name: "Not read"}]

    let {searchGenre, books}: SearchProps = $props();
    let selectedCat = $state(-1)

    function searchParam(cat: Category) {
        searchGenre = cat.name;
        if (selectedCat === cat.id) {
            selectedCat = -1;
            searchGenre = "";
        } else {
            selectedCat = cat.id;
            searchGenre = cat.name;
        }
    }

    const notReadBooks = $derived(
        books.filter(b => !b.started_reading).sort((a, b) => (a.created_at) - (b.created_at))
    );

</script>

<section>

    <h4>Sort by category</h4>
    <div class="btn-cat">
        {#each categories as cat}

            <Button isSelected={selectedCat === cat.id} onclick={() => searchParam(cat)}>{cat.name}</Button>

        {/each}

    </div>
    {#if searchGenre !== "Not read"}
        <BookCategory
                booksToDisplay={books.filter(book => book.genre === searchGenre).sort((a,b) => (b.rating ?? 0) - (a.rating ?? 0))}
                categoryName={searchGenre}/>
    {:else}
        <BookCategory booksToDisplay={notReadBooks} categoryName={searchGenre}/>
    {/if}
</section>

<style>
    .btn-cat :active {
        background-color: blue;
    }
</style>