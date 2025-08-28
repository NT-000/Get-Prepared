<script lang="ts">

    import {type Book, getUserState} from "$lib/state/user-state.svelte";
    import {BookCategory, Button} from "$components/index";
    import convertToLocalString from "$components/BookCard.svelte"
    import * as sea from "node:sea";

    type SearchProps = {
        searchGenre: string,
    }

    type Category = { id: number, name: string }

    let categories: Category[] = [
        {id: 1, name: "Classic"},
        {id: 2, name: "History"},
        {id: 3, name: "Fantasy"},
        {id: 4, name: "Psychology"},
        {id: 5, name: "Dystopia"},
        {id: 6, name: "Fiction"},
        {id: 7, name: "Not read"},
        {id: 8, name: "Currently reading"},
        {id: 9, name: "Finished books"}]

    let {searchGenre}: SearchProps = $props();
    let selectedCat = $state(-1)

    let userContext = getUserState();

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

</script>

<section>


    <div class="btn-cat">
        {#each categories as cat}
            <Button isSelected={selectedCat === cat.id} onclick={() => searchParam(cat)}>{cat.name}</Button>
        {/each}

    </div>
    {#if searchGenre !== "Not read" && searchGenre !== "Currently reading" && searchGenre !== "Finished books"}
        <BookCategory
                booksToDisplay={userContext.fetchBookByGenreSortedByRating(searchGenre)}
                categoryName={searchGenre}/>
    {:else if searchGenre === "Not read"}
        <BookCategory booksToDisplay={userContext.fetchUnreadBooks()} categoryName={searchGenre}/>
    {:else if searchGenre === "Currently reading"}
        <BookCategory booksToDisplay={userContext.fetchCurrentlyReading()} categoryName={searchGenre}/>
    {:else if searchGenre === "Finished books"}
        <BookCategory booksToDisplay={userContext.fetchFinishedBook()} categoryName={searchGenre}/>
    {/if}
</section>

<style>
    .btn-cat {
        object-fit: cover;
        background-color: transparent;
        width: 70%;
    }
</style>