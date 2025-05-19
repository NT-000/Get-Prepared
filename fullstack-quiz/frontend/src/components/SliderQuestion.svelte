<script>
import Button from "../shared/Button.svelte";
export let handleSliderAnswer;
export let question;
export let sliderValue;
</script>
<h2>{question.question}</h2>
    <form>
        <input type="range" min="{question.min}" max="{question.max}" bind:value={sliderValue}/>

        <p>Valgt verdi: {sliderValue}</p>
        <Button type="primary" on:click={() => handleSliderAnswer(sliderValue, question)} text="Send"/>
    </form>

<style>

</style>