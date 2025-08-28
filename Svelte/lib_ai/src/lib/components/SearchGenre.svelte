<script lang="ts">

    import type {Book} from "$lib/state/user-state.svelte";
    import {BookCategory, Button} from "$components/index";

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
        {id: 6, name: "Fiction"}]

    let {searchGenre, books}: SearchProps = $props();
    let selectedCat = $state(-1)

    function searchParam(cat: Category) {
        searchGenre = cat.name;
        if (selectedCat === cat.id) {
            selectedCat === -1;
            searchGenre = "";
        } else {
            selectedCat = cat.id;
            searchGenre = cat.name;
        }
    }

</script>

<section>

    <h4>Sort by category</h4>
    <div class="btn-cat">
        {#each categories as cat}
            <Button isSelected={selectedCat === cat.id} onclick={() => searchParam(cat)}>{cat.name}</Button>
        {/each}
    </div>
    <!--    <select bind:value={searchGenre}>-->
    <!--        {#each categories as cat}-->
    <!--            <option>{cat}</option>-->
    <!--        {/each}-->
    <!--    </select>-->
    <BookCategory booksToDisplay={books.filter(book => book.genre === searchGenre)} categoryName={searchGenre}/>
</section>

<style>
    .btn-cat :active {
        background-color: blue;
    }
</style>