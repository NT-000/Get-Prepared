<script>
export let data;
import {highscores} from "../../stores/scoreStore.js";


let copy_highscores = [...data.highscores]
console.log("copy_high:", copy_highscores)
console.log("highscores:", $highscores)
console.log("data", data)
</script>

<h1>Høyeste Poengsummer</h1>

<div class="container">
<div class="scores">
 {#each copy_highscores as score (score)}
  <h2>{score.new_gameType}</h2>
  <div>{score.username}</div>
  <div>{score.score} Poeng</div>

  <br>

  {/each}
</div>
</div>

<style>
.container{
 display: inline-block;
 padding: 10px;
 margin: 5px;

}
</style>