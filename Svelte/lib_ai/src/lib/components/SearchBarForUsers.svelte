<script lang="ts">

    type PublicUser = { id: string; name: string; user_id: string }
    let search = $state("")

    let result = $state<PublicUser[]>([])


    $inspect(search)

    let {userContext} = $props();

    async function handleKey(e: KeyboardEvent) {
        console.log("inside handleKey")
        if (e.key === 'Enter') {
            result = await userContext.fetchSearchQueryForUsers(search);
            console.log("result array after query:", result)
        } else {
            return;
        }
    }

</script>

<section>
    <input type="search" name="search-bar" placeholder="Search for other users" bind:value={search}
           onkeydown={handleKey}>

    {#if result.length}
        <div class="result-container">
            <div class="result-inner">
                <ul>
                    {#each result as user, i}
                        <li>
                            <a href={`/public-profile/${user?.user_id}`}> {user?.name}</a>
                        </li>
                    {/each}
                </ul>
            </div>
        </div>
    {/if}

</section>

<style>

    a {
        text-decoration: none;
    }

    a:hover {
        color: rgba(0, 154, 253, 0.8);
        font-weight: bold;
        opacity: 0.7;
    }

</style>
