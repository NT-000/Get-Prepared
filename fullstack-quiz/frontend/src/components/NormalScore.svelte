<script>

    import Card from "../shared/Card.svelte";

    export let question;

    const correctAnswer = question.options.find(option => option.isCorrect)

</script>

<main>
    <Card>

        Spørsmål:{question.question}

        <div class="answer">
            <label>Svar:</label>
            <strong>{question.answer.text}</strong>
            <br>
            <label>Riktig svar:</label>
            <strong>{correctAnswer.text}</strong>
        </div>
        Poeng: {question.points || 0}
    </Card>
</main>

<style>
    .answer {
        margin-top: 5px;

    }

    label {
        border-bottom: 3px solid #A5D6D9;
        font-weight: bolder;
    }
</style>