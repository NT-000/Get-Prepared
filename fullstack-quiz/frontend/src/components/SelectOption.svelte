<script>
    import {currentGame, gameTypes} from "../stores/gameStore.js";
$:console.log("currentGame:", $currentGame)
</script>


<div>
    <select bind:value={$currentGame}>
        <option disabled>Velg lengde på quizen</option>
        {#each $gameTypes as type (type.gameType)}
            <option value={type}>{type.gameType}</option>
        {/each}
    </select>
</div>