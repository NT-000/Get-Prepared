<script lang="ts">
    import {getUserState} from "$lib/state/user-state.svelte";
    import {Button} from "$components";
    import ModalConfirm from "$lib/shared/ModalConfirm.svelte";
    import Icon from "@iconify/svelte";

    let userContext = getUserState()
    let userName = $state(userContext.userName || "")
    let email = $state(userContext.user?.email || "")
    let isEditMode = $state(false)
    let isConfirmed = $state(false)


    let averageRating = $derived.by(() => {
        let allRatedBooks = userContext.userBooks.filter((book) => book.rating)
        if (allRatedBooks.length === 0) {
            return "No rated books yet."
        }
        const sumOfAllRatedBooks = allRatedBooks.reduce(
            (acc, book) => acc + book.rating!, 0
        )
        return Math.round(100 * sumOfAllRatedBooks / allRatedBooks.length) / 100;

    })

    async function handleAnswer(a: "yes" | "no") {

        if (a === "yes") {
            console.log("user deleted test")
            await userContext.deleteUser();
            isConfirmed = false;
        } else {
            isConfirmed = false;
        }
    }

    $effect(() => {
        if (userContext.userName) {
            userName = userContext.userName
        }
    })

    async function toggleEditModeAndSaveToDb() {
        if (isEditMode) {
            await userContext.updateUserInfo(email, userName)
        }
        isEditMode = !isEditMode
    }

</script>

<div class="settings-page">
    <div class="settings-container">
        <h2>Settings</h2>
        <h5 class="mt-m mb-xs semi-bold">Username</h5>
        {#if isEditMode}
            <input type="text" name="userName" bind:value={userName}/>
        {:else}
            <h3>{userName}</h3>
        {/if}
        <h5 class="mt-m mb-xs semi-bold">Email</h5>
        {#if isEditMode}
            <input type="text" name="email" bind:value={email}/>
        {:else}
            <h3>{email}</h3>
        {/if}
        <Button isSecondary={true}
                onclick={() => toggleEditModeAndSaveToDb()}>{isEditMode ? "Save changes" : "Edit"}
        </Button>
        {#if isEditMode}
            <Button onclick={() => isConfirmed = !isConfirmed}>Delete account</Button>
        {/if}
        {#if isConfirmed}
            <ModalConfirm isOpen={isConfirmed} onAnswer={handleAnswer}
            >Are You sure you want to delete your account? There's is no way to revert this.
            </ModalConfirm>
        {/if}
    </div>
    <div class="stats-container">
        <h3 class="h3-stats mb-s">User Stats
            <Icon icon="hugeicons:apple-stocks" width="40"></Icon>
        </h3>
        <h5 class="semi-bold">Books in library</h5>
        <h3>{userContext.userBooks.length !== null ? userContext.userBooks.length : "Loading"}</h3>
        <h5 class="semi-bold mt-m">Finished Books</h5>
        <h3>
            {userContext.userBooks.filter((book) => Boolean(book.finished_read)).length !== null ? userContext.userBooks.filter((book) => Boolean(book.finished_read)).length : "Loading"}
        </h3>
        <h5 class="semi-bold mt-m">Average rating on your books</h5>
        <h3>{averageRating}</h3>
    </div>
</div>

<style>
    .settings-page {
        display: flex;
        justify-content: flex-start;
        align-items: center;
        width: 100%;
    }

    .settings-container {
        margin-right: 80px;
    }

    .stats-container {
        min-width: 25%;
        border-radius: 12px;
        padding: 8px 24px;
        background-color: rgba(255, 255, 255, 0.5);
        margin-bottom: 40px;
    }

    .h3-stats {
        border-bottom: 2px solid grey;
        display: flex;
        gap: 10px;
    }
</style>

