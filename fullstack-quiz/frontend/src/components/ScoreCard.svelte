<script>
    import {questions_on_quiz} from "../stores/gameStore";
    import TimeLineScoreCard from "./TimeLineScoreCard.svelte";
    import NormalScore from "./NormalScore.svelte";
    import SliderIntervalScore from "./SliderIntervalScore.svelte";
    import SliderScore from "./SliderScore.svelte";
    import Button from "../shared/Button.svelte";

    export let isNewGame = false;
</script>

<main>
    <slot>
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
            <Button on:click={() => (isNewGame = true)}>Prøv igjen</Button>
        {/if}
    </slot>
</main>

<style>

</style>