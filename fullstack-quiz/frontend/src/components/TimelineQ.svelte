<script>
    export let question;
    let currentIndex = 0
    let points = []
    let lineEl;

    let hoverPosition = null
    let hoverValue = null

    const minYear = question.min;
    const maxYear = question.max;

    const handleClick = (e) => {

        if(points.length >= question.items.length) return

        const ratio = Math.max(0, Math.min(1, e.offsetX / e.currentTarget.clientWidth));
        points = [...points, { pos: ratio, label: question.items[currentIndex].label }];
        currentIndex += 1;
    }

    const valueFromRatio = (r) => {
        return Math.round(minYear + r * (maxYear - minYear));
    }


    const handleMouseMove = (e) => {

        const ratio = e.offsetX / e.currentTarget.clientWidth;
        hoverValue = valueFromRatio(ratio);
    }

    const handleMouseLeave = () => {

        hoverValue = null;
    }

</script>


<h3>Timeline</h3>
<h2>{question.question}</h2>
<p>Plasser: <strong>{question.items[currentIndex]?.label}</strong></p>
<div>
    <div class="timeline" bind:this={lineEl} on:click={handleClick} on:mousemove={handleMouseMove} on:mouseleave={handleMouseLeave}>

        {#each points as point, i (i)}
            <div class="marker" style="left: {point.pos * 100}%" on:click={() => {$points.splice(point, 1)}}>
                {valueFromRatio(point.pos)}
            </div>

        {/each}</div>
    {#if hoverValue !== null}
        <div class="hover-marker" style="left: {hoverPosition * 100}%">
            {hoverValue}
        </div>
    {/if}
</div>

{#if points.length === question.items.length}

{/if}

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