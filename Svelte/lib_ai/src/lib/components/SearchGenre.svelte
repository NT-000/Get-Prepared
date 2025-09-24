<script lang="ts">

    import {type Book, getUserState} from "$lib/state/user-state.svelte";
    import {BookCategory, Button} from "$components/index";
    import Icon from "@iconify/svelte";

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
        {id: 7, name: "Non-Fiction"},
        {id: 8, name: "Environment"},
        {id: 9, name: "Environmental Science"},
        {id: 10, name: "Literary fiction"},
        {id: 11, name: "Philosophy"},
        {id: 12, name: "Nature/Science"},
        {id: 13, name: "Popular science"},

        {id: 7, name: "Not read"},
        {id: 8, name: "Currently reading"},
        {id: 9, name: "Finished books"}]

    let {searchGenre}: SearchProps = $props();
    let selectedCat = $state(-1)
    let isGenre = $state(false)

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


    <button onclick={() => isGenre = !isGenre}>
        {#if isGenre}
                <span class="closed">Close Categories
                <span class="icon-wrapper">
                    <Icon class="icon" icon="solar:list-arrow-up-bold"/>
                </span>
                </span>
        {:else}

                <span class="open">Open Categories
                <span class="icon-wrapper">
                    <Icon class="icon" icon="solar:list-arrow-down-outline"/>
                </span>
                </span>
        {/if}
    </button>
    {#if isGenre}
        <div class="btn-cat">
            {#each categories as cat}
                <div>
                    <Button isDropdown={true} isSelected={selectedCat === cat.id}
                            onclick={() => searchParam(cat)}>{cat.name}</Button>
                </div>
            {/each}
        </div>
    {/if}

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
        display: flex;
        align-items: baseline;
        object-fit: cover;
        flex-wrap: wrap;
        width: 70%;
        gap: 10px;
        border-radius: 20px;

    }

    button {
        background-color: transparent;
        font-size: 40px;
    }

    .closed {
        width: 22px;
        height: 20px;
    }

    .icon-wrapper {
        display: inline-flex;
        font-size: 60px;
        transition: transform 0.2s ease, filter 0.2s ease;
    }

    .closed:hover .icon-wrapper,
    .open:hover .icon-wrapper {
        transform: scale(1.3);
    }

    .icon-wrapper:hover {
        font-weight: bold;
        transform: scale(1.3);
    }

</style>