<script>
import PollDetails from "./PollDetails.svelte";
import PollStore from "../stores/PollStore.js";
import {fade,slide, fly, crossfade,scale } from "svelte/transition";
import {flip} from "svelte/animate";

</script>

<main>

<h2>Active polls</h2>
    <div class="poll-list">

        {#each $PollStore as poll (poll.id)}
            <div in:scale out:scale|local animate:flip={{duration: 500}}>
            <PollDetails {poll} on:vote/>
            </div>
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