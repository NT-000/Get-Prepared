<script>
    import Button from "../../shared/Button.svelte";
    import {goto} from "$app/navigation";
    import {fetchCurrentUser, currentUser} from "../../stores/userStore.js";
    import Input from "../../shared/Input.svelte";
    import H1 from "../../shared/H1.svelte";

    let username = '';
    let password = '';
    $: console.log("Guestuser:", $currentUser)

    const handleLogin = async () => {
        try {
            const res = await fetch('/api/login', {
                method: 'POST',
                credentials: 'include',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({username, password})
            });
            const data = await res.json();
            console.log("data:", data);
            if (data.success) {
                await fetchCurrentUser()
                await goto('/quiz')
            }
        } catch (err) {
            console.log(err);
        }
    }

    const handleGuestLogin = async () => {
        const res = await fetch('/api/login_guest', {
            method: 'POST',
            credentials: 'include'
        });
        const data = await res.json();
        if (data.success) {
            console.log("Navigerer til quiz...");
            await fetchCurrentUser()
            await goto("/quiz")
            console.log("skulle ha navigert");
        } else {
            console.error("noe gikk feil, gjest")
        }
    };
</script>

<div class="login-form">
    <H1>Quiz</H1>
    <Input text="Username" bind:value={username} autocomplete="username"/>
    <Input text="Password" type="password" bind:value={password} autocomplete="current-password"/>
    <br>
    <div class="buttons">
        <Button on:click={() => handleLogin()}>Logg inn</Button>
        <Button on:click={() => handleGuestLogin()}>Logg inn som gjest</Button>
        <Button on:click={() => goto('/new_user')}>Ny bruker</Button>
    </div>
</div>
<div>


</div>

<style>

    .login-form {
        background-color: #ffffff;
        border-radius: 12px;
        padding: 32px;
        max-width: 400px;
        margin: 60px auto;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 16px;
    }

    .buttons {
        width: 100%;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    h1 {
        font-family: 'Segoe UI', 'Helvetica Neue', sans-serif;
        font-size: 2rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 24px;
    }
</style>