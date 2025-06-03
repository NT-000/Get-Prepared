<script>
    import NormalScore from "./NormalScore.svelte";
    import SliderQuestion from "./SliderQuestion.svelte";

    export let question;
    export let handleAnswer;
    export let handleSliderAnswer;
    export let sliderValue;

</script>

{#if question.type === 'normal'}
    <NormalScore {question} {handleAnswer}/>

{:else if question.type === 'slider'}
    <SliderQuestion {question} {handleSliderAnswer} {sliderValue}/>

{:else if question.type === 'multiple'}
    <ul style="list-style-type: none">
        {#each question.options as option (option.id)}
            <li>
                <input type="checkbox" id={option.id} on:change={() => handleAnswer(option, question)}/>
                <label for={option.id}>{option.text}</label>
            </li>
        {/each}
    </ul>
{:else}
    <p>Noe gikk feil...</p>
{/if}