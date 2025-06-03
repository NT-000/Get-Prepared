<script>


    import {goto} from "$app/navigation";
    import Button from "../../shared/Button.svelte";
    import Input from "../../shared/Input.svelte";
    import H1 from "../../shared/H1.svelte";

    let username = "";
    let name = "";
    let password = "";
    let passwordCheck = "";
    let usernameAvailable = null;

    $: if (username && username.length > 4) {
        checkUsername(username)
    }

    const checkUsername = async (username) => {
        if (password === passwordCheck) {
            const res = await fetch(`/api/check_user?username=${username}`, {
                method: 'GET',
                credentials: 'include'
            });
            const data = await res.json();
            usernameAvailable = !data.exists;
        }

    }
    const handleSubmit = async () => {
        if (usernameAvailable && username.length > 4) {
            const new_user = {
                "username": username,
                "name": name,
                "password": password
            }
            try {
                const res = await fetch('api/users', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(new_user)
                });
                const data = await res.json()
                if (data.success) {
                    await goto('/login')
                } else {
                    console.error("error:", data.message)
                }
            } catch (err) {
                console.error(err)
            }
        }
    }
</script>

<main>
    <form on:submit={handleSubmit}>

        <div class="fields">
            <div class="inputs">
                <div class="info"><H1 text="Lag ny bruker"/></div>
                <Input bind:value={username} text="Brukernavn..." on:blur={()=> checkUsername(username)}/>

                {#if usernameAvailable}
                    <p style="color: green;">Brukernavnet er ledig</p>
                {:else if usernameAvailable === false}
                    <p style="color: red;">Brukernavnet er allerede i bruk</p>
                {/if}

                <Input bind:value={name} text="Navnet ditt..."/>
                <Input bind:value={password} text="Velg ditt passord..."/>
                <Input bind:value={passwordCheck} text="Tast passordet på nytt...."/>
                <Button>Lag ny bruker</Button>
            </div>

        </div>

    </form>
</main>

<style>

    main {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #f5f7fa;

    }

    form {
        background-color: white;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
    }

    .info {
        text-align: center;
        margin-bottom: 24px;
    }

    .info h1 {
        font-size: 24px;
        font-weight: 600;
        color: #333;
    }

    input:focus {
        border-color: #0077ff;
        outline: none;
    }

    p {
        padding: 5px;
        font-weight: bolder;
        margin: 10px;

    }


    .inputs {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

</style>