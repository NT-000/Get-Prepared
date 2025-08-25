<script lang="ts">
    import {getUserState} from "$lib/state/user-state.svelte";
    import {BookCard, Button} from "$components";
    import Icon from "@iconify/svelte";

    const userContext = getUserState();
    let isOpen: boolean = $state(false);

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
    <Button onclick={() => isOpen = !isOpen}>Open book menu</Button>
    {#if userContext.userBooks?.length && isOpen}
        <ul>
            {#each userContext.userBooks as book}
                <li>
                    <BookCard {book}/>
                </li>
            {/each}
        </ul>
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