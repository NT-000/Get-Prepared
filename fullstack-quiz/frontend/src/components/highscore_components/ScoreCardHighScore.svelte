<script>

    import H1 from "../../shared/H1.svelte";

    export let highscoresLeaders;
    export let text = ""
    export let length;
    import {draw, fade} from "svelte/transition";
</script>


<div class="scores" in:fade={{ duration: 400 }}>
    <div class="title"><H1 text="{text}"/></div>
    {#each highscoresLeaders as score, i (i)}
        <div class={`score-card- ${i === 0 ? 'gold' : i === 1 ? 'silver' : i === 2 ? 'bronze' : ''}`} in:draw>
            <div class="header">
                <strong>
                    {i === 0 ? "🥇" : i === 1 ? "🥈" : i === 2 ? "🥉" : ""}
                </strong>
            </div>
            <h2> {score.gameType}</h2>
            <p><strong>{score.username}</strong></p>
            <p>{score.score} poeng</p>
        </div>
    {/each}
</div>


<style>

    .title {
        margin: 20px;
    }

    .scores {
        display: flex;
        flex-direction: column;
        gap: 26px;
        width: 100%;
        max-width: 500px;
    }


    .score-card- {
        padding: 16px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        text-align: center;
        transition: transform 0.2s;
        margin-left: 20px;
    }

    .gold {
        background: linear-gradient(90deg, #ffe259 0%, #ffa751 100%);
        color: #4c3b00;
        border: 2px solid gold;
    }

    .silver {
        background: linear-gradient(90deg, #e0eafc 0%, #cfdef3 100%);
        color: #465362;
        border: 2px solid silver;
    }

    .bronze {
        background: linear-gradient(90deg, #ffddb0 0%, #b97a56 100%);
        color: #63320a;
        border: 2px solid #b97a56;
    }


    .header {
        color: black;
        font-size: 2rem;

        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);

    }

    .score-card-:hover {
        transform: scale(1.02);
    }


</style>