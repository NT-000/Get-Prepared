<script>
    import {questions_on_quiz} from "../stores/gameStore";
    import Card from "../shared/Card.svelte";
    import TimeLineScoreCard from "./TimeLineScoreCard.svelte";
    import NormalScore from "./NormalScore.svelte";
    import SliderIntervalScore from "./SliderIntervalScore.svelte";


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
                    <p>slider</p>
                {:else if question.type === "sliderInterval"}
                    <SliderIntervalScore {question}/>
                {/if}
                <br>
            </div>
        {/each}

    </slot>
</main>

<style>
    .answer {
        margin-top: 5px;

    }

    label {
        border-bottom: 3px solid #A5D6D9;
        font-weight: bolder;
    }
</style>