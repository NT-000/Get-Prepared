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
    const res = await fetch('/api/login_guest', {
    method: 'POST',
    credentials: 'include'
  });
    const data = await res.json();
    if (data.success){
        console.log("Navigerer til quiz...");
        await fetchGuestUser()
        await goto("/quiz")
        console.log("skulle ha navigert");
    }
    else{
        console.error("noe gikk feil, gjest")
    }
};
</script>

<div class="login-form">
    <h1>Quiz</h1>
        <input type="text" placeholder="Username" bind:value={username} autocomplete="username"/>
        <input type="password" placeholder="Password" bind:value={password} autocomplete="current-password"/>
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
    display: inline-block;
        margin: 10px;
        padding: 10px;
        background: red;
        border-radius: 10px;
        justify-items: center;

    }
    .buttons{
        display: block;
        margin: 10px;
        padding: 10px;
    }
    input{
        margin: 10px;
        padding: 10px;
        border-radius: 10px;
        font-weight: bolder;
        font-family: "Comic Sans MS",emoji;
        box-shadow: 1px 2px 3px rgba(0,0,0,0.2);
        border: 3px solid gold;
    }
    h1{
    color: gold;
        text-shadow:
                0 0 5px black,
                0 0 10px white,
                0 0 20px white,
                0 0 40px white,
                0 0 80px white;
    }
    h1 text{
        border: black 1px solid;

    }
</style>