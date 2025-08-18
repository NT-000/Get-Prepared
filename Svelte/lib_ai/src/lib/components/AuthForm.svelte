<script lang="ts">
    import {Button} from "$components/index";
    import type {ActionData} from "../../../.svelte-kit/types/src/routes/register/$types";

    interface ComponentProps {
        isRegistration: boolean
        form: ActionData
    }

    let {isRegistration, form}: ComponentProps = $props();
</script>

<div class="default-margin auth-container">
    <div class="mb-l">
        <h1>{isRegistration ? "Register" : "Login"}</h1>
    </div>

    <div class="form-and-social-login">
        <form class="auth-form" method="POST" action={isRegistration ? "" : "/login/signInWithPassword"}>

            {#if form && form.errors?.length}
                {#each form.errors as error}
                    <div class="auth-error">
                        {error}
                    </div>
                {/each}
            {/if}
            {#if isRegistration}
                <input placeholder="Name" type="text" name="name" required value={form?.name || ""}>
            {/if}
            <input placeholder="Email" type="email" name="email" value={form?.email || ""} required>
            <input placeholder="Password" type="password" name="password" value={form?.password || ""} required>
            {#if isRegistration}
                <input placeholder="Confirm Password" autocomplete="new-password" type="password"
                       name="confirmPassword" required>
            {/if}

            <Button type="submit">{isRegistration ? "Register" : "Login"}</Button>

            {#if isRegistration}
                <p class="auth-hint mt-s">
                    <a href="/login" title="Go to login">Already have an account?</a>
                </p>
            {:else}
                <p class="auth-hint mt-s">
                    <a href="/register" title="Go to register">Don't have an account?</a>
                </p>
            {/if}
        </form>
        <div class="social-login">
            <form method="POST" action={isRegistration ? "/login/?/googleLogin" : "?/googleLogin"}>
                <Button type="submit">Log in using Google</Button>
            </form>
        </div>
    </div>
</div>

<style>
    .auth-container {
        margin-top: 80px;
    }

    .form-and-social-login {
        display: flex;
    }

    .auth-form {
        display: flex;
        flex-direction: column;
        align-items: start;
        border-right: 2px solid grey;
        width: 40%;
        padding-right: 80px;
    }

    .auth-container input:last-of-type {
        margin-bottom: 40px;
    }

    .auth-form input {
        width: 100%;
        margin-bottom: 13px;
    }

    .social-login {
        padding-left: 80px;
        width: 40%;
    }

    a {
        text-decoration: none;
        margin-left: 10px;

    }

    a:hover {
        font-weight: bold;
    }

    .auth-hint a {
        font-size: 17px;
        color: grey;
    }

    .auth-error {
        color: red;
        padding: 10px;
        font-size: 18px;
        width: 100%;
        margin-bottom: 10px;
        font-weight: bold;
    }

    .auth-error:last-of-type {
        margin-bottom: 16px;
    }
</style>