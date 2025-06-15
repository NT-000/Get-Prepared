<script>

    import A from "../shared/A.svelte";
    import {currentUser, guest} from "../stores/userStore.js";
    import {invalidateAll} from "$app/navigation";

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
                await invalidateAll();

            } else {
                console.error('utlogging feilet');
            }
        } catch {
            console.error('noe gikk galt ved utlogging')
        }
    }


</script>
{#if data.user.username}
    <header>

        <div class="logged-in-user">Innlogget bruker: <strong>{data.user.username}</strong></div>
        <A href="/login" text="Innlogging"/>
        <A href="/highscores" text="Høyeste poengsummer"/>
        <A href="/new_user" text="Ny bruker"/>
        {#if data.user}
            <div>
                <A href="/login" onclick={logOut} text="Logg ut"/>
            </div>  <!--Svelte 5 syntax for on:click = onclick-->
        {/if}
    </header>
{/if}

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