<script>
    import H1 from "../../shared/H1.svelte";

    export let data;
    import {highscores} from "../../stores/scoreStore.js";

    let copy_highscores = [...data.highscores]
    console.log("copy_high:", copy_highscores)
    console.log("highscores:", $highscores)
    console.log("data", data)
</script>


<div class="container">

    <div class="scores">
        <H1>Høyeste Poengsummer</H1>
        {#each copy_highscores as score (score)}
            <div class="score-card">
                <h2>{score.new_gameType}</h2>
                <p><strong>{score.username}</strong></p>
                <p>{score.score} poeng</p>
            </div>
        {/each}
    </div>
</div>

<style>
    .container {
        display: flex;
        justify-content: center;
        padding: 20px;
    }

    .scores {
        display: flex;
        flex-direction: column;
        gap: 16px;
        width: 100%;
        max-width: 500px;
    }

    .score-card {
        background-color: #f0f4ff;
        padding: 16px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        text-align: center;
        transition: transform 0.2s;
    }

    .score-card:hover {
        transform: scale(1.02);
    }

    h1 {
        text-align: center;
        font-size: 2rem;
        margin-top: 20px;
        color: #333;
    }
</style>