<script>
  import Card from "../../shared/Card.svelte";
  import {currentUser, guest} from "../../stores/userStore.js";
  export let data;
  import {score, gameTypes, currentGame, questionsAsked} from "../../stores/gameStore.js"
  import NormalQuestion from "../../components/NormalQuestion.svelte";
  import SliderQuestion from "../../components/SliderQuestion.svelte";
  import TimelineQ from "../../components/TimelineQ.svelte";
  import {goto} from "$app/navigation";
  import SliderInterval from "../../components/SliderInterval.svelte";
  import SelectOption from "../../components/SelectOption.svelte";

  let question;
  let sliderValue = 0;

  let error_message = ""
  let gameOver = false
  let gameStart = false
  let copy_questions = [...data.questions]

  $:console.log("antall spørsmål", $questionsAsked)
  const logOut = async () => {
          try {
            const res = await fetch(`/api/logout`, {
            method: 'POST',
            credentials: 'include',
            });
            if (res.ok) {
                currentUser.set(null);
                guest.set(null);
                await goto("/login")
            } else {
                console.error('Logout feilet');}
          } catch (err) {
              console.error('Something went wrong logging out', err)
          }
  }

  console.log("guest:",$guest)
  console.log("currentUser",$currentUser)
  $: console.log("scoreStore: ", $score);

  const handleAnswer = (option, question) => {
    if (option.isCorrect || option === question.correctAnswer) {
        option.isCorrect ? console.log(`correct answer: ${option.text} + ${question.points} points!`) : console.log(`correct answer: ${question.correctAnswer} + ${question.points} points!`);
      $score += question.points;

    } else{
      option ? console.log(`wrong answer: ${option.text} - ${question.points} points!`) : console.log(`wrong answer: ${question.option} - ${question.points} points!`);
      $score - question.points >= 0 ? $score -= question.points : 0;
    }
    sliderValue = 0
    pickQuestion();
  };

    const pickQuestion = async () => {

    if($questionsAsked > $currentGame.questions) {

        const new_score_object = {username: $currentUser.username, score: $score, gameType: $currentGame.gameType}
        console.log("Sending score object:", new_score_object);


        gameOver = true;
        error_message = "Game over! your scoreStore: " + $score
        try {
          await fetch(`/api/scores`, {
              method: "POST",
              credentials: "include",
              headers: {
                  'Content-Type': 'application/json'
              },
              body: JSON.stringify(new_score_object)
          })
      }catch (err){
          console.error("error", err)
      }
      return;
    }
    const index = Math.floor(Math.random() * copy_questions.length)
    question = copy_questions[index];
    copy_questions.splice(index, 1);
    $questionsAsked++;
}

  const newGame = () => {
      $score = 0;
      $questionsAsked = 0;
      gameOver = false
      error_message = ''
      copy_questions = [...data.questions]
      pickQuestion();
      gameStart = true
  }
  $: console.log("gametype:", $gameTypes)
</script>

{#if $currentUser || $guest}
<div><button onclick={logOut}>Logg ut</button></div>  <!--Svelte 5 syntax for onclick-->
    {/if}
{#if $currentUser}
    <h1>Velkommen til Quiz, {$currentUser.name}</h1>
{:else if $guest}
    <h1>Velkommen til Quiz, {$guest.username}</h1>
{/if}
{#if gameStart === true}
<div class="container">
    <Card>
        <h3>Dine poeng: {$score}</h3>
        <h3>Spørsmål igjen {$currentGame.questions - $questionsAsked +1}</h3>
        <div class="form">
            {#if !gameOver && question}
                <br>
                {#if question.type === 'normal'}
                    <NormalQuestion {question} {handleAnswer}/>
                {:else if question.type === 'slider'}
                    <SliderQuestion {question} {handleAnswer} {sliderValue}/>
                {:else if question.type === 'timeline'}
                    <TimelineQ {question} {pickQuestion}/>
                {:else if question.type === 'sliderInterval'}
                    <SliderInterval {question} {pickQuestion}/>
                {/if}
            {/if}
        </div>
    </Card>
</div>
    {/if}
            {#if !gameStart}
                <div class="btn">
                <p>{error_message}</p>
                <SelectOption/>
                <button onclick={newGame} disabled={gameStart}>Start nytt spill</button>
                    </div>

            {/if}

<style>
    .container{
        display: flex;
        justify-content: center;
        align-items: center;
        position: page;

    }
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
    .btn{

    }
</style>
