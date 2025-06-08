<script>
    import {onDestroy, onMount} from 'svelte';
    import noUiSlider from 'nouislider';
    import 'nouislider/dist/nouislider.css';
    import Button from "../shared/Button.svelte";
    import {score, questions_on_quiz} from "../stores/gameStore.js"
    import Paragraph from "../shared/Paragraph.svelte";

    export let question;
    export let pickQuestion;
    export let audioWin;
    export let audioLose;

    let isShowHint = false;
    let pointsEarned = 0;
    const toggleHint = () => {
        isShowHint = !isShowHint
        $score -= 0.5;
        audioLose.play();
        pointsEarned -= 0.5
    }

    let range = [question.min, question.max];
    let sliderEl;
    $: correct = range[0] === question.correctMin && question.correctMax === range[1];


    onDestroy(() => {
        if (sliderEl && sliderEl.noUiSlider) {
            sliderEl.noUiSlider.destroy();
        }
    });

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


        if (correct && question.difficulty === 'easy') {
            $score += 2
            pointsEarned += 2
            audioWin.play()
            console.log("easy, diff:", correct, question.difficulty)
        } else if (correct && question.difficulty === 'medium') {
            $score += 3
            audioWin.play()
            pointsEarned += 3
            console.log("medium, diff:", correct, question.difficulty)
        } else if (correct && question.difficulty === 'hard') {
            $score += 5
            audioWin.play()
            pointsEarned += 5
            console.log("hard, diff:", correct, question.difficulty)
        } else {
            $score - question.points >= 0 ? $score -= 1 : $score = 0
            audioLose.play()
            pointsEarned - question.points >= 0 ? pointsEarned -= 1 : pointsEarned = 0
            console.log("-1 point")
        }
        $questions_on_quiz.push({...question, answer: (range[0] + "-" + range[1]), points: pointsEarned})
        pickQuestion();
    }

</script>
<h2>Slider Intervall</h2>
<p>{question.question}</p>
{#if !isShowHint}
    <div onclick={toggleHint}>Vis hint (-0.5 poeng)</div>
{/if}
{#if isShowHint}
    Hint:
    <Paragraph>Finn intervallet på {Math.round(question.correctMax - question.correctMin)}</Paragraph>
{/if}
<div class="interval">
    <div class="form">
        <div bind:this={sliderEl}></div>
        <p>Tidsperiode: {range[0]} – {range[1]}</p>
        <Button type="primary" text="Bekreft svar" on:click={() => handleAnswer()}/>
    </div>
</div>

<style>

</style>