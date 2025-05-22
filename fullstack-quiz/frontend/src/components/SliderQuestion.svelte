<script>
import Button from "../shared/Button.svelte";
export let handleAnswer;
export let question;
export let sliderValue;
</script>
<h2>{question.question}</h2>
        <input type="range" min="{question.min}" max="{question.max}" bind:value={sliderValue}/>

        <p>Valgt verdi: {sliderValue}</p>
        <Button type="primary" on:click={() => handleAnswer(sliderValue, question)} text="Send"/>

<style>

</style>