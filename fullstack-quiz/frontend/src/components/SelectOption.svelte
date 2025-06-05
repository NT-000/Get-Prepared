<script>
    import {currentGame, gameTypes} from "../stores/gameStore.js";

    $:console.log("currentGame:", $currentGame)
</script>


<div class="input">
    <select bind:value={$currentGame}>
        <option disabled>Velg lengde på quizen</option>
        {#each $gameTypes as type (type.gameType)}
            <option value={type}>{type.gameType}</option>
        {/each}
    </select>
</div>

<style>
    select {
        border-radius: 10px;
        padding: 5px;
        text-align: center;
    }

    select:focus {
        border: none;
        background: lightblue;
    }
</style>