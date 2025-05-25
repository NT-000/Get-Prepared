<script>
      import { onMount } from 'svelte';
  import noUiSlider from 'nouislider';
  import 'nouislider/dist/nouislider.css';
      import Button from "../shared/Button.svelte";
      import {score} from "../stores/scoreStore.js"
      import {questionStore} from "../stores/QuestionStore.js";
  export let question;
  export let pickQuestion;

    let range = [0,0];
    let sliderEl;
    let correct = range[0] === question.correctMin &&  question.correctMax === range[1];
    let difficulty = question.difficulty

    $: if (question) { range = [question.min, question.max]}
    $: console.log("range", range)
onMount(() => {
        if(!question) return

        try {
            noUiSlider.create(sliderEl, {
                start: range,
                connect: true,
                step: question.step,
                range: {
                    min: question.min,
                    max: question.max,
                },
            });

            sliderEl.noUiSlider.on('update', (values) => {
                range = values.map(v => Math.round(v));
            });
        } catch (err) {
            console.error("Slider failed:", err);
        }

})
;

    const handleAnswer = () => {
        if(range[0] === question.correctMin &&  question.correctMax === range[1] && question.difficulty === 'easy'){
            $score += 1
            console.log("easy, diff:", correct, question.difficulty)
        }
        else if(range[0] === question.correctMin &&  question.correctMax === range[1] && question.difficulty === 'medium'){
            $score += 2
            console.log("medium, diff:", correct, question.difficulty)
        }
        else if(range[0] === question.correctMin &&  question.correctMax === range[1] && question.difficulty === 'hard'){
            $score += 3
            console.log("hard, diff:", correct, question.difficulty)
        }
        else{
            $score -=1
            console.log("-1 point")
        }
        questionStore.update( (questions) => {
      return questions.filter(q => q.question !== question.question)
    });
        pickQuestion();
    }

</script>
<h2>Slider Intervall</h2>
<p>{question.question}</p>
<p>Finn intervallet på {Math.round(question.correctMax-question.correctMin)}</p>
<div class="interval">
    <div class="form">
        <div bind:this={sliderEl}></div>
        <p>Tidsperiode: {range[0]} – {range[1]}</p>
        <Button type="primary" text="Bekreft svar" on:click={() => handleAnswer()}/>
    </div>
</div>

<style>

</style>