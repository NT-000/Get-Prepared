<script>
    import Button from "../shared/Button.svelte";
    import {score} from "../stores/gameStore.js";
    export let pickQuestion
    import {questions_on_quiz} from "../stores/gameStore.js";

    export let question;
    let currentIndex = 0
    let points = []
    let lineEl;

    let errorMessage = ""
    let hoverPosition = null
    let hoverValue = null


    let minYear = question.min;
    let maxYear = question.max;
  $: if(question){
        minYear = question.min;
        maxYear = question.max;
    }
    $: console.log("points:", points)
    $: console.log("scoreStore til:", $score)

    const clickSound = new Audio('/pop.mp3');

    const handleClick = (e) => {
        if(points.length >= question.items.length) return
        const ratio = Math.max(0, Math.min(1, e.offsetX / e.currentTarget.clientWidth));
        points = [...points, { pos: ratio, value: valueFromRatio(ratio) , label: question.items[currentIndex].label }];
        currentIndex += 1;
        clickSound.currentTime = 0;
        clickSound.play();
    }

    const valueFromRatio = (ratio) => {
        const range = maxYear - minYear;
        const offset = ratio * range;
        const yearValue = minYear + offset;
        return Math.round(yearValue);
    }

    const handleMouseMove = (e) => {
        const ratio = e.offsetX / e.currentTarget.clientWidth;
        hoverValue = valueFromRatio(ratio);
    }

    const handleAnswer = () =>{
        let pointsEarned = 0;

        if(points.length !== 3) return errorMessage = "Fyll inn alle punktene på tidslinjen."

        for (let i = 0; i < points.length; i++){
            if(points[i].value === question.items[i].correctValue){
                $score += 1
                pointsEarned += 1
                console.log("Du greide det, + 1p")
            }
        }

        const isCorrectOrder = points.every((point, index) => point.label === question.correctOrder[index]);
        if(isCorrectOrder){

            $score += 3

            pointsEarned += 3
            console.log("Du greide det, + 3p")
        }
        else {
            $score - question.points >= 0 ? $score -=3 : $score = 0
            pointsEarned - question.points >= 0 ? pointsEarned -=3 : $score = 0
            console.log("Du greide det ikke, - 3p")
        }
        $questions_on_quiz.push({...question, answer_time: points, isCorrectOrder, _points: pointsEarned})
        points = []
        currentIndex = 0
        pickQuestion()

    }

    const getYearLabels = () => {
        const labels = [];
        const start = Math.floor(minYear / 10) * 10;
        const end = Math.ceil(maxYear / 10) * 10;
        let step = 25;
        question.max - question.min < 101 ? step = 25 : step = 50;
        for (let y = start; y <= end; y += step) {
            labels.push(y);
        }
        return labels;
    };


</script>


<h3>Timeline</h3>
<h2>{question.question}</h2>
{#if points.length + 1 <= question.items.length}
    <p>Plasser: <strong>{question.items[currentIndex]?.label}</strong></p>
{/if}
<div class="container">
    <div class="hover-value">
        <strong>{hoverValue}</strong>
    </div>
    <div class="timeline" bind:this={lineEl} on:click={handleClick} on:mousemove={handleMouseMove} on:mouseleave={() => hoverValue = null}>
        {#each points as point, i (i)}
            <div class="marker" style="left: {point.pos * 100}%">
                {valueFromRatio(point.pos)}
            </div>
        {/each}

        {#each getYearLabels() as year, i (i)}
            <div class="year-tick" style="left: {(100 * (year - minYear) / (maxYear - minYear))}%">
                <div class="tick-line"></div>
                <div class="tick-label">{year}</div>
            </div>
        {/each}
    </div>

    <div class="hover-marker" style="left: {hoverPosition * 100}%"></div>

</div>

<p class="error">{errorMessage}</p>
<Button type="button" on:click={() => handleAnswer()}>Bekreft svar</Button>
<button on:click={() => { points = [], currentIndex = 0}}>Tilbakestill markører</button>


<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #1e1e1e;
        color: black;
        margin: 0;
        padding: 0;
        text-align: center;
    }

    .container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 100%;
        min-height: 500px;
        padding: 2rem;
    }

    h2, h3 {
        color: black;
        margin-bottom: 1rem;
    }

    .timeline {
        position: relative;
        width: 100%;
        max-width: 600px;
        height: 60px;
        background: #333;
        border: 2px solid #777;
        border-radius: 10px;
        margin-top: 1.5rem;
        cursor: crosshair;
    }

    .marker {
        position: absolute;
        top: 50%;
        transform: translate(-50%, -50%);
        width: 40px;
        height: 40px;
        background: #ff4d4f;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 0.75rem;
        z-index: 10;
        box-shadow: 0 0 10px rgba(255, 77, 79, 0.7);
        animation: popIn 0.3s ease-out;
    }

    @keyframes popIn {
        0% {
            opacity: 0;
            transform: translate(-50%, -50%) scale(0.5);
        }
        100% {
            opacity: 1;
            transform: translate(-50%, -50%) scale(1);
        }
    }

    .marker:hover {
        background: #ff7875;
    }

    .hover-marker {
        position: absolute;
        top: -30px;
        transform: translateX(-50%);
        background: #444;
        padding: 4px 8px;
        border-radius: 5px;
        color: #ddd;
        font-size: 0.8rem;
        white-space: nowrap;
    }

    button, .primary {
        margin-top: 1rem;
        padding: 0.75rem 1.5rem;
        background-color: #1890ff;
        border: none;
        border-radius: 5px;
        color: white;
        font-size: 1rem;
        cursor: pointer;
        transition: background 0.3s;
    }

    button:hover {
        background-color: #40a9ff;
    }

    .reset {
        margin-top: 0.5rem;
        background-color: #f5222d;
    }

    .reset:hover {
        background-color: #ff4d4f;
    }

    .year-tick {
        position: absolute;
        bottom: -25px;
        transform: translateX(-50%);
        text-align: center;
        color: #ccc;
        font-size: 0.7rem;
        z-index: 5;
    }

    .tick-line {
        width: 2px;
        height: 8px;
        background-color: #999;
        margin: 0 auto 3px;
    }

    .tick-label {
        white-space: nowrap;
    }

    .error{
        color: red;
        font-size: 0.8rem;
        font-weight: bolder;
    }
    .hover-value{
        margin-bottom: 20px;
    }


</style>
