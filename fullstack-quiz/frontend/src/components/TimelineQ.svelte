<script>
    import Button from "../shared/Button.svelte";
    import {questionStore} from "../stores/QuestionStore.js";
    import {score} from "../stores/scoreStore.js";
    export let pickQuestion

    export let question;
    let currentIndex = 0
    let points = []
    let lineEl;


    let hoverPosition = null
    let hoverValue = null

    const minYear = question.min;
    const maxYear = question.max;
$: console.log("points:", points)
    $: console.log("scoreStore tl:", $score)
    const handleClick = (e) => {
        if(points.length >= question.items.length) return
        const ratio = Math.max(0, Math.min(1, e.offsetX / e.currentTarget.clientWidth));
        points = [...points, { pos: ratio, value: valueFromRatio(ratio) , label: question.items[currentIndex].label }];
        currentIndex += 1;
    }

    const valueFromRatio = (r) => {
        return Math.round(minYear + r * (maxYear - minYear));
    }


    const handleMouseMove = (e) => {
        const ratio = e.offsetX / e.currentTarget.clientWidth;
        hoverValue = valueFromRatio(ratio);
    }

    const handleAnswer = () =>{
    for (let i = 0; i < points.length; i++){
                        if(points[i].value === question.items[i].correctValue){
                    $score += 1
                    console.log("Du greide det, + 1p")
                }
    }
    const labelsIsInOrder = points.map(p => p.label)
    const isCorrectOrder = labelsIsInOrder.every((label, index) => label === question.correctOrder[index]);
        if(isCorrectOrder){
            $score += 3
            console.log("Du greide det, + 3p")
        }
        else {$score -=3;
            console.log("Du greide det ikke, - 3p")}

        questionStore.update( (questions) => {
      return questions.filter(q => q.question !== question.question)})
        pickQuestion()
    }

</script>


<h3>Timeline</h3>
<h2>{question.question}</h2>
{#if points.length <= question.items.length}
<p>Plasser: <strong>{question.items[currentIndex]?.label}</strong></p>
    {/if}
<div>
    <div class="timeline" bind:this={lineEl} on:click={handleClick} on:mousemove={handleMouseMove} on:mouseleave={() => hoverValue = null}>

        {#each points as point, i (i)}
            <div class="marker" style="left: {point.pos * 100}%">
                {valueFromRatio(point.pos)}
            </div>
        {/each}

    </div>

    {#if hoverValue !== null}
        <div class="hover-marker" style="left: {hoverPosition * 100}%">
           Valgt: {hoverValue}
        </div>
    {/if}
</div>

{#if points.length === question.items.length}

{/if}
<Button type="primary" on:click={handleAnswer}>Bekreft svar</Button>
<button on:click={() => { points = [], currentIndex = 0}}>Reset markører</button>


<style>
    .timeline {
        position: relative;
        max-width: 100%;
        min-width: 400px;
        height: 50px;
        background: grey;
        margin: 2em auto;
        padding: 10px;
        border-radius: 5px;
    }

    .marker {
        position: absolute;
        top: 50%;
        height: 100%;
        transform: translate(-50%, -50%);
        width: 10%;
        background: tomato;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.7em;
        color: white;
        z-index: 10;
        cursor: pointer;
    }
    .marker:hover{
        z-index: 10;
        cursor: pointer;
    }
</style>