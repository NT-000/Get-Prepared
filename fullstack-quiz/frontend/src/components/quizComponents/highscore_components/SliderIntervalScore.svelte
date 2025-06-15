<script>

    import Card from "../../../shared/Card.svelte";

    export let question;

    let isOpen = false;
</script>

<main>
    <Card correct={question.points > 0} wrong={question.points === 0} active={isOpen} bind:isOpen>
        <div>{question.question}</div>
        {#if isOpen}
            <div class="answer">
                <label>Svar:</label>
                <strong>{question.answer}</strong>
                <br>
                <label>Riktig svar:</label>
                <strong>Mellom {question.correctMin + "-" + question.correctMax}</strong>
            </div>
            Poeng: {question.points}
        {/if}

    </Card>
</main>


<style>
    .answer {
        margin-top: 5px;
    }

    label {
        font-weight: bolder;
    }
</style>