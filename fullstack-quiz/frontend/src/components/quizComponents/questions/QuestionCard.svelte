<script>
    import {score, questionsAsked} from "../../../stores/gameStore.js";
    import {questionStore} from "../../../stores/QuestionStore.js";
    import Card from "../../../shared/Card.svelte";
    import NormalQuestion from "./NormalQuestion.svelte";
    import SliderQuestion from "./SliderQuestion.svelte";
    import TimelineQ from "./TimelineQ.svelte";
    import SliderInterval from "./SliderInterval.svelte";

    const {gameStart, question, pickQuestion, audioWin, audioLose} = $props()
</script>


<div class="container">
    <Card>
        <h3>Dine poeng: {$score}</h3>
        <h3>Spørsmål igjen {$questionStore.length - $questionsAsked}</h3>
        <div class="form">
            {#if gameStart && question}
                <br>
                {#if question.type === 'normal'}
                    <NormalQuestion {question} {pickQuestion} {audioWin} {audioLose}/>
                {:else if question.type === 'slider'}
                    <SliderQuestion {question} {pickQuestion} {audioWin} {audioLose}/>
                {:else if question.type === 'timeline'}
                    <TimelineQ {question} {pickQuestion} {audioWin} {audioLose}/>
                {:else if question.type === 'sliderInterval'}
                    {#key question}
                        <SliderInterval {question} {pickQuestion} {audioWin} {audioLose}/>
                    {/key}
                {/if}
            {/if}
        </div>
    </Card>
</div>

<style>
    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 60vh;
        margin-top: 36px;
    }


    .form {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 18px 2px 0 2px;
        border-radius: 12px;
        width: 100%;
        background: transparent;
        box-shadow: none;
        text-align: center;
        gap: 22px;
    }

    h3 {
        font-size: 1.1rem;
        font-weight: 500;
        margin: 0 0 7px 0;
        color: #254b80;
        letter-spacing: 1px;
    }
</style>