<script>


    import {goto} from "$app/navigation";
    import Button from "../../shared/Button.svelte";

    let username = "";
    let name = "";
    let password = "";
    let passwordCheck = "";
    let usernameAvailable = null;

    $: if (username && username.length > 4){
        checkUsername(username)
    }

        const checkUsername = async (username) => {
        if(password === passwordCheck){
            const res = await fetch(`/api/check_user?username=${username}`, {
                method: 'GET',
                credentials: 'include'
            });
            const data = await res.json();
            usernameAvailable = !data.exists;
        }

    }
    const handleSubmit = async () =>{
        if(usernameAvailable && username.length > 4){
            const new_user = {
                "username": username,
                "name": name,
                "password": password
            }
            try{
                    const res = await fetch('api/users', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'
              },
              body: JSON.stringify(new_user)
                });
               const data = await res.json()
               if(data.success){
                   await goto('/login')
               }
               else{
                   console.error("error:", data.message)
               }
            }catch (err) {
                console.error(err)
            }
        }
    }
</script>

<main>
    <h1>Lag ny bruker</h1>
    <form on:submit={handleSubmit}>
        <div class="container">
            <div class="fields">
                <input type="text" bind:value={username} placeholder="Brukernavn...">
                {#if username.length > 4}
                    {#if usernameAvailable === null}
                        <p>Sjekker brukernavn...</p>
                    {:else if usernameAvailable}
                        <p style="color: green;">Brukernavnet er ledig</p>
                    {:else}
                        <p style="color: red;">Brukernavnet er allerede i bruk</p>
                    {/if}
                {/if}

                <input type="text" bind:value={name} placeholder="Navnet ditt...">
                <input type="text" bind:value={password} placeholder="Velg ditt passord...">
                <input type="text" bind:value={passwordCheck} placeholder="Tast passordet på nytt....">
                <Button>Lag ny bruker</Button>

            </div>
        </div>
    </form>
</main>

<style>
input{
    display: flex;
    border-radius: 10px;
    padding: 5px;
    text-align: center;
    font-weight: bolder;
    background: #A5D6D9;
    margin: 10px;
}
p{
    padding: 5px;
    font-weight: bolder;
    margin:10px;
}
</style>