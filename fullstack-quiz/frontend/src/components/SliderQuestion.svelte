<script>
    import Button from "../shared/Button.svelte";

    export let question;
    import {score} from "../stores/gameStore.js";
    import {questions_on_quiz} from "../stores/gameStore.js";

    export let pickQuestion;

    let sliderValue = 0;

    const handleAnswer = (sliderValue, question) => {
        let pointsEarned = 0;

        sliderValue === question.correctAnswer ? console.log(`correct answer: ${question.question} + ${question.points} points!`) : console.log(`wrong answer: ${question.question} - ${question.points} points!`);
        sliderValue === question.correctAnswer ? $score += question.points : $score = Math.max(0, $score - question.points);
        sliderValue === question.correctAnswer ? pointsEarned += question.points : pointsEarned = Math.max(0, $score - question.points);

        $questions_on_quiz.push({...question, answer: sliderValue, points: pointsEarned});
        console.log("spørsmål fått 2:", $questions_on_quiz)
        sliderValue = 0;
        pickQuestion();
    };

</script>
<h2>{question.question}</h2>
<input type="range" min="{question.min}" max="{question.max}" bind:value={sliderValue}/>
<p>Valgt verdi: {sliderValue}</p>
<Button type="button" on:click={() => handleAnswer(sliderValue, question)} text="Send"/>

<style>

</style>