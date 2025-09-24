<script lang="ts">

    import {type Book, type BookProfile, getUserState} from "$lib/state/user-state.svelte";
    import BookCardProfile from "$components/BookCardProfile.svelte";

    let {data} = $props();


    const {profile, books} = data;

    const userContext = getUserState()

    const profileBooks = $derived<BookProfile[]>(books)

    console.log("user:", data.books,)


</script>

<section>
    <h3>Profile for {profile.name ? profile.name : "Unknown"}.</h3>
    <div class="container-profile">
        <div class="book-view-profile">
            {#if profileBooks.length === 0}
                <p>No books in their library</p>
            {/if}
            {#if profile.user_id === userContext.user?.id}
                <div>This is the logged in users' screen</div>
            {/if}
            <ul>
                {#if profileBooks.length && profile.user_id !== userContext.user?.id}
                    {#each profileBooks as book}
                        {#if book.finished_read}
                            <li>
                                <BookCardProfile {book}/>
                            </li>
                        {/if}
                    {/each}
                {/if}
            </ul>
        </div>
    </div>
</section>

<style>

</style>
