<script>
    import NormalQuestion from "./NormalQuestion.svelte";
    import SliderQuestion from "./SliderQuestion.svelte";

    export let question;
    export let handleAnswer;
    export let handleSliderAnswer;
    export let sliderValue;
    export let minInterval;
    export let maxInterval;
</script>

{#if question.type === 'normal'}
<NormalQuestion {question} {handleAnswer}/>

    {:else if question.type === 'slider'}
    <SliderQuestion {question} {handleSliderAnswer} {sliderValue}/>

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