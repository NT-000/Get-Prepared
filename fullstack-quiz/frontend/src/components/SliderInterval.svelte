<script>
    import {onMount} from 'svelte';
    import noUiSlider from 'nouislider';
    import 'nouislider/dist/nouislider.css';
    import Button from "../shared/Button.svelte";
    import {score, questions_on_quiz} from "../stores/gameStore.js"

    export let question;
    export let pickQuestion;

    let range = [0, 0];
    let sliderEl;
    $: correct = range[0] === question.correctMin && question.correctMax === range[1];

    $: if (question) {
        range = [question.min, question.max]
    }

    $:                 if (sliderEl && sliderEl.noUiSlider) {
        sliderEl.noUiSlider.set([question.min, question.max]);
    }


    onMount(() => {
        if (question.min !== null && question.max !== null) {
            constructSlider();
        }

    })
    ;
    const constructSlider = () => {
        if (!question) return

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
    }

    const handleAnswer = () => {

        let pointsEarned = 0;
        if (correct && question.difficulty === 'easy') {
            $score += 2
            pointsEarned += 2

            console.log("easy, diff:", correct, question.difficulty)
        } else if (correct && question.difficulty === 'medium') {
            $score += 3
            pointsEarned += 3
            console.log("medium, diff:", correct, question.difficulty)
        } else if (correct && question.difficulty === 'hard') {
            $score += 5
            pointsEarned += 5
            console.log("hard, diff:", correct, question.difficulty)
        } else {
            $score - question.points >= 0 ? $score -= 1 : $score = 0
            pointsEarned - question.points >= 0 ? pointsEarned -= 1 : pointsEarned = 0
            console.log("-1 point")
        }
        $questions_on_quiz.push({...question, answer: (range[0] + "-" + range[1]), points: pointsEarned})

        pickQuestion();


    }

</script>
<h2>Slider Intervall</h2>
<p>{question.question}</p>
<p>Finn intervallet på {Math.round(question.correctMax - question.correctMin)}</p>
<div class="interval">
    <div class="form">
        <div bind:this={sliderEl}></div>
        <p>Tidsperiode: {range[0]} – {range[1]}</p>
        <Button type="primary" text="Bekreft svar" on:click={() => handleAnswer()}/>
    </div>
</div>

<style>

</style>