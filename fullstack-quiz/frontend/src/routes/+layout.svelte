<script>

    import A from "../shared/A.svelte";
    import {currentUser} from "../stores/userStore.js";
    import {invalidateAll} from "$app/navigation";

    const {data, children} = $props()

    $effect(() => {
        console.log("logged-in user:", data.user)
    })

    const logOut = async () => {
        try {
            const res = await fetch(`/api/logout`, {
                method: 'POST',
                credentials: 'include',
            });
            if (res.ok) {
                currentUser.set(null);
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

        <div class="navbar">
            <div class="navbar-left">
                <span class="logo"> <img src="/el_logo.png"></span>
                <span class="logged-in-user">🔑<strong>{data.user.username}</strong>
            </span>
            </div>
            <nav class="navbar-right">
                <A href="/login" text="Startside" emoji="🏠"/>
                <A href="/highscores" text="Høyeste poengsummer" emoji="🏆"/>
                <A href="/quiz" text="Lag ny quiz" emoji="🧩"/>
                {#if data.user}
                    <A href="/login" onclick={logOut} text="Logg ut" emoji="🏃🚪"/>
                {/if}
            </nav>
        </div>
    </header>
{/if}

{@render children()}
<footer>© 2025 El Kameleono</footer>


<style>
    header {
        padding: 0;
        width: 100%;
        height: 100px;
        background-color: #005fcc;
        border-radius: 10px;
        border: 3px solid black;
        margin-bottom: 24px;
    }

    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 30px;
        gap: 20px;
    }

    .navbar-left {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .logo {
        font-size: 1.3rem;
        font-weight: bold;
        color: #fff76e;
        letter-spacing: 2px;
    }

    .logo img {
        width: 95px;
        height: 75px;
    }

    .logged-in-user {
        font-size: 1.2rem;
        color: lawngreen;
    }

    .navbar-right {
        display: flex;
        align-items: center;
        gap: 18px;
    }


    footer {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 10px;
        font-style: italic;
    }
</style>