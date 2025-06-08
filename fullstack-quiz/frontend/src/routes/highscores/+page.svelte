<script>
    export let data;
    import {highscores} from "../../stores/scoreStore.js";
    import ScoreCardHighScore from "../../components/highscore_components/ScoreCardHighScore.svelte";

    let copy_highscores = [...data.highscores.slice(0, 10)]
    console.log("copy_high:", copy_highscores)
    console.log("highscores:", $highscores)
    console.log("data", data)

    let highscoresShort = copy_highscores.filter(sGame => sGame.gameType === "Kort - 10 spørsmål").slice(0, 10)
    let highscoresMedium = copy_highscores.filter(sGame => sGame.gameType === "Medium - 20 spørsmål").slice(0, 10)
    let highscoresLong = copy_highscores.filter(sGame => sGame.gameType === "Lang - 30 spørsmål").slice(0, 10)

    let highscoresLeaders;
    let length;

</script>


<div class="container">

    <div>
        <ScoreCardHighScore highscoresLeaders={copy_highscores} text="Høyeste poengsummer"/>
    </div>

    <div>
        <ScoreCardHighScore highscoresLeaders={highscoresShort} text="Topp 10 - Kort spill" length="short"/>
    </div>

    <div>
        <ScoreCardHighScore highscoresLeaders={highscoresMedium} text="Topp 10 - Medium spill" length="medium"/>
    </div>

    <div>
        <ScoreCardHighScore highscoresLeaders={highscoresLong} text="Topp 10 - Langt spill" length="long"/>
    </div>
</div>

<style>
    .container {
        display: flex;
        justify-content: center;
        padding: 20px;
    }


    h1 {
        text-align: center;
        font-size: 2rem;
        margin-top: 20px;
        color: #333;
    }
</style>