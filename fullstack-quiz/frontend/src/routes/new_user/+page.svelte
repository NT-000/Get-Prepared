<script>


    import {goto} from "$app/navigation";
    import Button from "../../shared/Button.svelte";
    import Input from "../../shared/Input.svelte";
    import H1 from "../../shared/H1.svelte";

    let username = "";
    let name = "";
    let password = "";
    let passwordCheck = "";
    let usernameAvailable;
    let isPasswordLook = false
    let passwordLook = "password"
    let passCheck = ""

    const togglePassLook = () => {
        isPasswordLook = !isPasswordLook
        if (isPasswordLook) {
            passwordLook = ""
        } else {
            passwordLook = "password"
        }
    }

    const checkUsername = async (username) => {
        if (username.length > 4) {
            const res = await fetch(`/api/check_user?username=${username}`, {
                method: 'GET',
                credentials: 'include'
            });
            const data = await res.json();
            usernameAvailable = !data.exists;
        } else {
            console.error("Brukernavn for kort, mer enn 4 tegn")
            usernameAvailable = null
        }

    }
    const handleSubmit = async () => {
        if (password !== passwordCheck) {
            passCheck = "Passordene er ikke like."
        }
        if (usernameAvailable && password === passwordCheck) {
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
    <form on:submit|preventDefault={handleSubmit}>

        <div class="fields">
            <div class="inputs">
                <div class="info"><H1 text="Lag ny bruker"/></div>

                <div class="name-check">
                    <Input bind:value={username} typeInput="name-check" text="Brukernavn..." type="new-name"
                           on:blur={()=> checkUsername(username)}/>
                    {#if usernameAvailable}
                        <p style="color: green;">Brukernavnet er ledig</p>
                    {:else if usernameAvailable === false}
                        <p style="color: red;">Brukernavnet er allerede i bruk</p>
                    {:else if username.length < 4 && username.length > 1}
                        <p>Brukernavnet må inneholde mer enn fire tegn.</p>
                    {/if}
                </div>
                <Input bind:value={name} text="Navnet ditt..."/>

                <div class="pass-wrapper">
                    <Input bind:value={password} text="Velg ditt passord..." type="{passwordLook}"
                           autocomplete="new-password"/> <img src="/eye.png"
                                                              class="eye-icon"
                                                              on:mouseleave={togglePassLook}
                                                              on:mouseover={togglePassLook}>
                </div>

                <div class="pass-wrapper">
                    <Input bind:value={passwordCheck} text="Tast passordet på nytt...." type="{passwordLook}"
                           autocomplete="new-password"/>
                    <img src="/eye.png"
                         class="eye-icon"
                         on:mouseleave={togglePassLook}
                         on:mouseover={togglePassLook}>
                </div>
                <p>{passCheck}</p>
                <Button type="submit">Lag ny bruker</Button>
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

    .pass-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }

    .eye-icon {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        width: 24px;
        height: 24px;
        cursor: pointer;
        opacity: 0.7;
        z-index: 10;
    }

    .eye-icon:hover {
        opacity: 1;
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
        margin-bottom: 10px;
        font-size: 0.8rem;
        width: 100%;
    }

    .name-check p {
        width: 500px;
        color: #40a9ff;
    }


    .inputs {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

</style>