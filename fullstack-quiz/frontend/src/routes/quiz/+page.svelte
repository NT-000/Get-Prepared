<script>
  import {onMount} from "svelte";
  import Card from "../../shared/Card.svelte";
  import {currentUser, guest} from "../../stores/userStore.js";
  export let data;
  import {score, gameTypes, currentGame, questionsAsked, questions_on_quiz} from "../../stores/gameStore.js"
  import NormalQuestion from "../../components/NormalQuestion.svelte";
  import SliderQuestion from "../../components/SliderQuestion.svelte";
  import TimelineQ from "../../components/TimelineQ.svelte";
  import {goto} from "$app/navigation";
  import SliderInterval from "../../components/SliderInterval.svelte";
  import SelectOption from "../../components/SelectOption.svelte";
  import Button from "../../shared/Button.svelte";
  import H1 from "../../shared/H1.svelte";

  let question;


  let error_message = ""
  let gameOver = false
  let gameStart = false
  let copy_questions = [...data.questions]
  let difficulty = 'easy'
  const difficulties = ['easy','medium','hard']
  let selectedCategories = []
  let categories =['Sport', 'Naturvitenskap', 'Historie', 'Musikk', 'Mat og drikke', 'Kunst og kultur', 'Vitenskap', 'Film', 'Geografi', 'Litteratur', 'Samfunn', 'Astronomi', 'Teknologi', 'Filosofi', 'Miljø']

  $: console.log("vanskelighetsgrad:",difficulty)
  $: console.log("VALGTE KATERGORIER:", selectedCategories)
  $:console.log("antall spørsmål", $questionsAsked)
  $:console.log("spørsmål:", data.questions)
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
          } catch{
              console.error('Something went wrong logging out', error_message)
          }
  }

  console.log("guest:",$guest)
  console.log("currentUser",$currentUser)
  $: console.log("scoreStore: ", $score);
  $: console.log("spørsmål fått:", $questions_on_quiz)

    const pickQuestion = async () => {

    if($questionsAsked >= $currentGame.questions) {

        const new_score_object = {username: ($currentUser || $guest).username, score: $score, gameType: $currentGame.gameType}
        console.log("Sending score object:", new_score_object);
        gameOver = true;
        gameStart = false;
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
      }catch{
          console.error("error", error_message)
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
<div><Button on:click={logOut} text="Logg ut"/></div>  <!--Svelte 5 syntax for on:click = onclick-->

    {/if}
<div class="logged-in">
{#if $currentUser}
    <H1>Velkommen til Quiz, {$currentUser.name}!</H1>
{:else if $guest}
    <H1>Velkommen til Quiz, {$guest.username}!</H1>
{/if}
    </div>
{#if gameStart === true}
<div class="container">
    <Card>
        <h3>Dine poeng: {$score}</h3>
        <h3>Spørsmål igjen {$currentGame.questions - $questionsAsked}</h3>
        <div class="form">
            {#if !gameOver && question}
                <br>
                {#if question.type === 'normal'}
                    <NormalQuestion {question} {pickQuestion}/>
                {:else if question.type === 'slider'}
                    <SliderQuestion {question} {pickQuestion}/>
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
                    <p>Velg spilltype</p>
                <SelectOption/>
                    <label>Katergori</label>
                    <div>
                        {#each categories as cat, i (i)}
  <label>{cat}</label>
  <input type="checkbox" value={cat} bind:group={selectedCategories} />
{/each}
                        <select bind:value={difficulty}>
                            {#each difficulties as level, i (i)}
                                <option>{level}</option>
                            {/each}
                        </select>
                    </div>
                    <Button type="button" on:click={newGame} disabled={gameStart} text="Start nytt spill"/>
                    </div>

            {/if}

<style>
.container {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 20px;
}

.form {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 24px;
    border-radius: 10px;
    width: 100%;
    max-width: 600px;
    background-color: #f9f9f9;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    text-align: center;
}

label {
    font-weight: 600;
    font-size: 1rem;
    margin-bottom: 6px;
}

h3 {
    font-family: 'Segoe UI', 'Helvetica Neue', sans-serif;
    color: #333;
    margin: 10px;
}


.btn {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 20px;
    gap: 12px;
}

.logged-in{
    display: flex;
    flex-direction: column;
    justify-items: center;
    align-items: center;
}
</style>
