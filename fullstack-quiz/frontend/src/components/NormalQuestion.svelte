<script>
    import {questions_on_quiz, score} from "../stores/gameStore.js";

    export let pickQuestion;
    export let question;
    export let audioWin;
    export let audioLose;

    const handleAnswer = (option) => {
        let pointsEarned = 0;
        const isCorrect = option?.isCorrect;
        if (isCorrect) {
            $score += question.points;
            pointsEarned = question.points;
            audioWin.play()
            console.log(`correct answer: ${question.question} + ${question.points} points!`);
        } else {
            $score = Math.max(0, $score - question.points);
            audioLose.play()
            pointsEarned = 0;
            console.log(`wrong answer: ${question.question} - ${question.points} points!`);
        }

        $questions_on_quiz.push({...question, answer: option, points: pointsEarned});
        pickQuestion();
    };
</script>

<h2>{question.question}</h2>
<ul style="list-style-type: none">
    {#each question.options as option, i (i)}
        <li on:click={() => handleAnswer(option)}>{option.text}</li>
    {/each}
</ul>

<style>
    li:hover {
        cursor: pointer;
        background-color: #eee;
        width: 100%;
        height: 100%;
    }

    li {
        margin: 10px;
        font-family: comic sans ms, serif;
        font-size: 1.5em;
    }
</style>