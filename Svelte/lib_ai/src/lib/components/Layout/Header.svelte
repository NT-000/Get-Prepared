<script lang="ts">

    import logo from "$assets/logo.png"
    import {Button} from "$components"
    import {getUserState} from "$lib/state/user-state.svelte";

    let userContext = getUserState()
    const {user, userName} = $derived(userContext);

    $inspect(user)

</script>

<header>
    <a href={user ? "/private/dashboard" : "/"}>
        <img src="{logo}" class="logo" alt="home">
    </a>


    <nav>
        {#if !user}
            <ul>
                <li>
                    <Button href="/register" isMenu={true}>Create new account</Button>
                </li>
                <li>
                    <Button href="/login" isMenu={true} isSecondary={true}>Login</Button>
                </li>

            </ul>
        {:else}
            <ul>
                <li>
                    <p>Logged in user, {userName}</p>
                    <Button isMenu={true} onclick={() => userContext.logout()}>Log out</Button>
                </li>
            </ul>
        {/if}
    </nav>
</header>

<style>
    .logo {
        max-width: 72px;
    }

    header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 4vw;
    }

    ul {
        display: flex;
        column-gap: 24px;
        align-items: center;
    }

    li {
        list-style: none;
    }
</style>