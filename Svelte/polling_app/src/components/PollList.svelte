<script>
import PollDetails from "./PollDetails.svelte";


export let polls = [];

</script>

<main>

<h2>Active polls</h2>
    <div class="poll-list">
        {#each polls as poll (poll.id)}
            <PollDetails {poll} on:vote/>
            {/each}
    </div>

</main>

<style>
    .poll-list{
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-gap: 20px;

    }
</style>