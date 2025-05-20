<script>
import Button from "../../shared/Button.svelte";
import {goto} from "$app/navigation";

let username = '';
let password = '';

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
        console.log(data);
        if(data.success){
           await goto('/quiz')
        }
    }
    catch(err){
        console.log(err);
    }

}
</script>

<div class="login-form">
    <h1>Login</h1>
    <form on:submit|preventDefault={handleLogin}>
        <input type="text" placeholder="Username" bind:value={username}/>
        <input type="password" placeholder="Password" bind:value={password}/>
        <Button>Logg inn</Button>
    </form>
</div>

<style>
    .login-form {

    }
</style>