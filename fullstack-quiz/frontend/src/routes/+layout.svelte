<script>

    import A from "../shared/A.svelte";
    import Button from "../shared/Button.svelte";
    import {currentUser, guest} from "../stores/userStore.js";
    import {goto} from "$app/navigation";

    const {data, children} = $props()

    const logOut = async () => {
        try {
            const res = await fetch(`/api/logout`, {
                method: 'POST',
                credentials: 'include',
            });
            if (res.ok) {
                currentUser.set(null);
                guest.set(null);
                await goto("/login")

            } else {
                console.error('utlogging feilet');
            }
        } catch {
            console.error('noe gikk galt ved utlogging')
        }
    }

</script>
<header>
    {#if data.user.username}
        <div class="logged-in-user">Innlogget bruker: <strong>{data.user.username}</strong></div>
        <A href="/login" text="Innlogging"/>
        <A href="/highscores" text="Høyeste poengsummer"/>
        <A href="/new_user" text="Ny bruker"/>
        {#if data.user}
            <div>
                <Button on:click={logOut} text="Logg ut"/>
            </div>  <!--Svelte 5 syntax for on:click = onclick-->
        {/if}
    {:else}
    {/if}
</header>
{@render children()}
<footer>© 2025 El Kameleono</footer>


<style>
    header {
        margin: 10px;
        padding: 10px;
        text-align: center;
        background-color: #005fcc;
        border-radius: 10px;
    }

    footer {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 10px;
        font-style: italic;
    }

    .logged-in-user {
        font-size: 0.8rem;
        padding: 10px;
        color: white;
    }
</style>