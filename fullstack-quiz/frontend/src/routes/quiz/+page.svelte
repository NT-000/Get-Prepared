<script>
  import { questionStore } from '../../stores/QuestionStore.js';
  import Card from "../../shared/Card.svelte";
  import {onMount} from "svelte";
  export let data;
  questionStore.set(data.questions);


  let score = 0
  let question = ""
  let number_array = []

  const pickQuestion = () => {
    const index = random();
    question = data.questions[index];
}


  $: console.log("score: ", score);

  const handleAnswer = (option, question) => {
    if (option.isCorrect) {
      console.log(`Riktig: ${option.text}`);
      score += question.points;

    } else {
      console.log(`Feil: ${option.text}`);
      score -= question.points;
    }
    questionStore.update( (questions) => {
      return questions.filter(q => q.question !== question.question)
    });
    pickQuestion();
  };

  let fill_array = () => {
    for (let i = 0; i < data.questions.length; i++) {
        number_array.push(i)
    }
  }
  const random = () => {
      return Math.floor(Math.random() * data.questions.length)
  }

    onMount(async () => {
     await fill_array();
     await pickQuestion()();
  })
</script>

<h1>Velkommen til Quiz</h1>
<div>
    <Card>
        <form class="form" on:submit|preventDefault={handleAnswer}>
            <h3>Score: {score}</h3>
            <br>

        <h2>{question.question}</h2>

        <ul style="list-style-type: none">
            {#each question.options as option}
               <li on:click={() => handleAnswer(option, question)}>{option.text}</li>
                {/each}
        </ul>

        </form>
    </Card>
</div>

<style>
    label {
        font-weight: bold;
        font-size: 1.2em;
    }

    li:hover{
        cursor: pointer;
        background-color: #eee;
    }
    li{
        margin: 10px;
    }
</style>
