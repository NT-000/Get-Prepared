<script>
    import NormalQuestion from "./NormalQuestion.svelte";
    import Button from "../shared/Button.svelte";

    export let question;
    export let handleAnswer;
    export let handleSliderAnswer;
    export let sliderValue = 50;
    export let minInterval;
    export let maxInterval;
    export let option;
</script>

{#if question.type === 'normal'}
<NormalQuestion {question} {handleAnswer}/>

    {:else if question.type === 'slider'}
    <form>
        <input type="range" min="{question.min}" max="{question.max}" bind:value={sliderValue}/>

        <p>Valgt verdi: {sliderValue}</p>
        <Button type="primary" on:sliderAnswer={handleSliderAnswer} />
    </form>
       {:else if question.type === 'multiple'}
       <ul style="list-style-type: none">
           {#each question.options as option (option.id)}
               <li>
                   <input type="checkbox" id={option.id} on:change={() => handleAnswer(option, question)} />
                   <label for={option.id}>{option.text}</label>
               </li>
           {/each}
       </ul>
    <!--{:else if question.type === 'sliderInterval'}-->
    <!--<form>-->
    <!--    <input type="range" min="0" max="100" bind:value={sliderValue} on:change={handleAnswer}/>-->
    <!--    <p>Valgt verdi: {sliderValue}</p>-->
    <!--</form>-->
    {:else}
    <p>Noe gikk feil...</p>
{/if}