<script>
  import { questionStore } from '../../stores/QuestionStore.js';
  import Card from "../../shared/Card.svelte";
  import {onMount} from "svelte";
  export let data;
  questionStore.set(data.questions);

  import NormalQuestion from "../../components/NormalQuestion.svelte";
  import SliderQuestion from "../../components/SliderQuestion.svelte";

  let question;
  let sliderValue;

  let score = 0
  let number_array = []
  let error_message = ""
  let gameOver = false

  console.log("num array: ", number_array);

  const pickQuestion = () => {
    if(data.questions.length === 0) {
        gameOver = true;
        error_message = "Game over! Din score: " + score
      return;
    }
    if(number_array.length === 0) {
      error_message = "No more questions left!"
    }
      const index = random();
    question = data.questions[index];
    data.questions.splice(index, 1);
    console.log("num array: ", number_array);
}
  const random = () => {
      return Math.floor(Math.random() * data.questions.length)
  }

    let fill_array = () => {
    for (let i = 0; i < data.questions.length; i++) {
        number_array.push(i)
    }
  }

  $: console.log("score: ", score);

  const handleAnswer = (option, question) => {
    if (option.isCorrect) {
      console.log(`Riktig: ${option.text} + ${question.points} poeng!`);
      score += question.points;

    } else {
      console.log(`Feil: ${option.text} - ${question.points} poeng!`);
      score -= question.points;
    }
    questionStore.update( (questions) => {
      return questions.filter(q => q.question !== question.question)
    });
    pickQuestion();
  };

  const handleSliderAnswer = (sliderValue, question) => {
      if(question.correctAnswer === sliderValue) {
          score += question.points;
          console.log(`Riktig: ${sliderValue} + ${question.points} poeng!`);
      } else {
          score -= question.points;
          console.log(`Feil: ${sliderValue} - ${question.points} poeng!`);
      }
      questionStore.update( (questions) => {
          return questions.filter(q => q.question !== question.question)
      });
      pickQuestion();
  }

    onMount(async () => {
     await fill_array();
     await pickQuestion();
  })

  const newGame = () => {
      score = 0;
      questionStore.set(data.questions);
      pickQuestion();
  }
</script>

<h1>Velkommen til Quiz</h1>
<div>
    <Card>
        <h3>Score: {score}</h3>
        <form class="form">
        {#if !gameOver && question}

            <br>

        {#if question.type === 'normal'}
<NormalQuestion {question} {handleAnswer}/>

    {:else if question.type === 'slider'}
    <SliderQuestion {question} {handleSliderAnswer} {sliderValue}/>
            {:else}
            <p>Ukjent spilltype</p>
            {/if}

{/if}

        {#if gameOver}
            <p>{error_message}</p>
            <button on:click={newGame}>Start nytt spill</button>
        {/if}

        </form>
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
