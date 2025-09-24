<script lang="ts">
    import {type Book, getUserState} from "$lib/state/user-state.svelte";
    import Icon from "@iconify/svelte";
    import BookCategory from "$components/BookCategory.svelte";
    import SearchGenre from "$components/SearchGenre.svelte";
    import LoadingSpinner from "$lib/shared/LoadingSpinner.svelte";
    import SearchBarForUsers from "$components/SearchBarForUsers.svelte";


    let searchGenre = $state("")
    const userContext = getUserState();
    let isOpen: boolean = $state(true);

    let isLoading = $state(true)

    let booksFromFavoriteGenre = $derived(userContext.fetchFavoriteGenre())

    $inspect(isOpen)
    $inspect(userContext.userName)
    $inspect(userContext.userBooks)


</script>

<section class="dashboard">
    <SearchBarForUsers {userContext}/>
    {#if userContext.userBooks?.length && isOpen}
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

        <SearchGenre {searchGenre}/>
        <BookCategory booksToDisplay={userContext.userBooks.slice(0,5)} categoryName={"Random books"}/>

        {#if userContext.fetchFavoriteBooks().length}
            <BookCategory booksToDisplay={userContext.fetchFavoriteBooks()}
                          categoryName={"Your Top Rated Books"}/>
        {/if}
        {#if userContext.fetchFavoriteGenre()}
            <BookCategory booksToDisplay={userContext.fetchBookByGenreSortedByRating(booksFromFavoriteGenre ?? "")}
                          categoryName={`Your top genre: ${userContext.fetchFavoriteGenre()}`}/>
        {/if}


    {:else if !userContext.userBooks.length}
        <div class="no-books">
            <a href="/private/scan-shelf">
                <h4>You currently have zero books in your library, click here to add some.
                </h4>

            </a>
        </div>

    {:else}
        <LoadingSpinner>Loading books...</LoadingSpinner>
    {/if}

</section>
<style>
    .dashboard-header {
        display: flex;
        justify-content: space-between;
        width: 100%;
        align-items: flex-start;
    }

    .no-books {
        display: flex;
        flex-direction: row;
        text-align: center;
        justify-content: flex-start;
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

    a:hover {
        text-decoration: underline;
        cursor: pointer;
    }

    h4 {
        font-style: italic;
    }

</style>