<script lang="ts">
    import {type Book, getUserState} from "$lib/state/user-state.svelte";
    import Icon from "@iconify/svelte";
    import BookCategory from "$components/BookCategory.svelte";
    import SearchGenre from "$components/SearchGenre.svelte";

    let searchGenre = $state("")
    const userContext = getUserState();
    let isOpen: boolean = $state(true);

    let booksFromFavoriteGenre = $derived(userContext.fetchFavoriteGenre())

    $inspect(isOpen)
    $inspect(userContext.userName)
    $inspect(userContext.userBooks)


</script>

<section class="dashboard">
    <div class="dashboard-header mb-m">

        <a href="/private/scan-shelf" class="add-book">
            <Icon icon="solar:add-circle-outline" width="70" height="100"/>
            <p>Add new book</p>
        </a>
        <div class="headline">
            <h3>Hello, {userContext.user?.user_metadata.full_name}!</h3>
            <p>Your place to add new favorites, all at one place</p>
        </div>
    </div>
    <!--    <Button onclick={() => isOpen = !isOpen}>Open book menu</Button>-->
    {#if userContext.userBooks?.length && isOpen}

        <SearchGenre {searchGenre}/>
        <BookCategory booksToDisplay={userContext.userBooks.slice(0,5)} categoryName={"Random books"}/>

        <BookCategory booksToDisplay={userContext.fetchFavoriteBooks()}
                      categoryName={"Your Top Rated Books"}/>
        <BookCategory booksToDisplay={userContext.fetchBookByGenreSortedByRating(booksFromFavoriteGenre ?? "")}
                      categoryName={`Your top genre: ${userContext.fetchFavoriteGenre()}`}/>
    {/if}
</section>

<style>
    .dashboard-header {
        display: flex;
        justify-content: space-between;
        width: 100%;
        align-items: flex-start;
    }

    .add-book {
        display: flex;
        align-items: center;
        text-decoration: none;
    }

    .add-book p {
        margin-left: 8px;
    }

    .add-book:hover {
        cursor: pointer;
    }

    .headline {
        text-align: right;
        max-width: 30%;
        min-width: 300px;
    }

    a {
        text-decoration: none;
    }

</style>