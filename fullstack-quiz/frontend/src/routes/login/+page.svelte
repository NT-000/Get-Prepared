<script>
import Button from "../../shared/Button.svelte";
import {goto} from "$app/navigation";
import {fetchCurrentUser, fetchGuestUser, guest} from "../../stores/userStore.js";

let username = '';
let password = '';
$: console.log("Guestuser:", $guest)

const handleLogin = async () => {
    try{
        const res = await fetch('/api/login', {
            method: 'POST',
            credentials: 'include',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ username, password })
        });
        const data = await res.json();
        console.log("data:",data);
        if(data.success){
           await fetchCurrentUser()
           await goto('/quiz')
        }
    }
    catch(err){
        console.log(err);
    }
}

const handleGuestLogin = async () => {
    const res = await fetch('/api/logged_in_guest', {
    method: 'POST',
    credentials: 'include'
  });
    const data = await res.json();
    if (data.success){
        await fetchGuestUser()
        await goto("/quiz")
    }
    else{
        console.error("noe gikk feil, gjest")
    }
};
</script>

<div class="login-form">
    <h1>Login</h1>
    <form on:submit|preventDefault={handleLogin}>
        <input type="text" placeholder="Username" bind:value={username}/>
        <input type="password" placeholder="Password" bind:value={password}/>
        <Button>Logg inn</Button>
    </form>
</div>
<div>
    <form on:submit|preventDefault={handleGuestLogin}>
        <Button>Logg inn som gjest</Button>
    </form>
</div>

<style>
    .login-form {

    }
</style>