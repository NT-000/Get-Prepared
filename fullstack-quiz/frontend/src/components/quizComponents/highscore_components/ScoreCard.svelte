<script>
    import {questions_on_quiz} from "../../../stores/gameStore.js";
    import TimeLineScoreCard from "./TimeLineScoreCard.svelte";
    import NormalScore from "./NormalScore.svelte";
    import SliderIntervalScore from "./SliderIntervalScore.svelte";
    import SliderScore from "./SliderScore.svelte";
    import Button from "../../../shared/Button.svelte";

    export let isNewGame = false;
    const handleNewGame = () => {
        isNewGame = true
        $questions_on_quiz = []
    }

</script>

<main>

    {#each $questions_on_quiz as question, i (i)}
        <div>
            {#if question.type === "timeline"}
                <TimeLineScoreCard {question}/>
            {:else if question.type === "normal"}
                <NormalScore {question}/>
            {:else if question.type === "slider"}
                <SliderScore {question}/>
            {:else if question.type === "sliderInterval"}
                <SliderIntervalScore {question}/>
            {/if}
            <br>
        </div>
    {/each}
    {#if !isNewGame}
        <Button on:click={handleNewGame}>Prøv igjen</Button>
    {/if}

</main>

<style>

</style>