<script>
  import { questionStore } from '../../stores/QuestionStore.js';
  import Card from "../../shared/Card.svelte";
  import {onMount} from "svelte";
  import {currentUser, fetchCurrentUser} from "../../stores/userStore.js";
  export let data;

  import NormalQuestion from "../../components/NormalQuestion.svelte";
  import SliderQuestion from "../../components/SliderQuestion.svelte";
  import TimelineQ from "../../components/TimelineQ.svelte";

  let question;
  let sliderValue = 0;

  let score = 0
  let error_message = ""
  let gameOver = false
  let gameStart = false
  let copy_questions = [...data.questions]


  console.log($currentUser)

  const pickQuestion = () => {
    if(copy_questions.length <= 27) {
        gameOver = true;
        error_message = "Game over! your score: " + score
      return;
    }

    const index = Math.floor(Math.random() * copy_questions.length)
    question = copy_questions[index];
    copy_questions.splice(index, 1);
}


  $: console.log("score: ", score);

  const handleAnswer = (option, question) => {
    if (option.isCorrect || option === question.correctAnswer) {
        option.isCorrect ? console.log(`correct answer: ${option.text} + ${question.points} points!`) : console.log(`correct answer: ${question.correctAnswer} + ${question.points} points!`);
      score += question.points;

    } else {
      option ? console.log(`wrong answer: ${option.text} - ${question.points} points!`) : console.log(`wrong answer: ${question.option} - ${question.points} points!`);
      score -= question.points;
    }
    questionStore.update( (questions) => {
      return questions.filter(q => q.question !== question.question)
    });
    pickQuestion();
  };

    onMount(async () => {

     await fetchCurrentUser();
     await pickQuestion();
  })

  const newGame = () => {
      score = 0;
      gameOver = false
      error_message = ''
      copy_questions = [...data.questions]
      pickQuestion();
  }
</script>

{#if $currentUser}
    <h1>Velkommen til Quiz, {$currentUser.username}</h1>
{/if}
<div>
    <Card>
        <h3>Score: {score}</h3>
        <p>Spørsmål igjen {copy_questions.length}</p>
        <div class="form">
            {#if !gameOver && question}
                <br>
                {#if question.type === 'normal'}
                    <NormalQuestion {question} {handleAnswer}/>
                {:else if question.type === 'slider'}
                    <SliderQuestion {question} {handleAnswer} {sliderValue}/>
                {:else if question.type === 'timeline'}
                    <TimelineQ {question}/>
                {/if}
            {/if}

            {#if gameOver}
                <p>{error_message}</p>
                <button on:click={newGame}>Start nytt spill</button>
            {/if}
        </div>
    </Card>
</div>

<style>
    .form {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin: 10px;
        padding: 10px;
        border: 5px solid black;
        border-radius: 5px;
        width: 50%;
        height: 50%;
        text-align: center;
    }
    label {
        font-weight: bold;
        font-size: 1.2em;
    }

    li:hover{
        cursor: pointer;
        background-color: #eee;
        width: 100%;
        height: 100%;
    }
    li{
        margin: 10px;
        font-family: comic sans ms,serif;
        font-size: 1.5em;
    }
    h1{
        text-align: center;
        margin-top: 20px;
        margin-bottom: 20px;
        font-size: 3em;
    }
    h1, h2, h3, li{
        font-family: comic sans ms,serif;
        margin: 10px;
    }
</style>
