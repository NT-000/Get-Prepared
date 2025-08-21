<script lang="ts">
    import {getUserState} from "$lib/state/user-state.svelte";

    import {Button} from "$components";

    const userContext = getUserState();
    let isOpen: boolean = $state(false);

    $inspect(isOpen)
    $inspect(userContext.userName)
    $inspect(userContext.userBooks)

</script>


<section>
    <h2>Hello, {userContext.user?.user_metadata.full_name} || {userContext.userName}</h2>
    <Button onclick={() => isOpen = !isOpen}>Open book menu</Button>
    {#if userContext.userBooks?.length && isOpen}
        <ul>
            {#each userContext.userBooks as book}
                <li>
                    <div class="book">
                        <img src="{book.cover_img}" alt="cover">
                        <h2>Title: {book.title}</h2>
                        <h3>Author: {book.author}</h3>
                        <h3>Genre: {book.genre}</h3>
                        <h3>Description:</h3>
                        <p>{book.description}</p>
                        <h3>Rating: {book.rating}/5</h3>
                        {#if book.started_reading}
                            <h4>Started reading: {book.started_reading}</h4>
                        {:else}
                            Not read
                        {/if}
                        {#if book.finished_read}
                            <h4>Finished reading: {book.finished_read}</h4>
                        {/if}
                    </div>
                </li>
            {/each}
        </ul>
    {/if}
</section>

<style>

</style>