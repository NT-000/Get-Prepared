<script>
    import Card from "../shared/Card.svelte";

    export let question;

</script>


<div>
    <Card>

        Spørsmål:{question.question}

        <div class="answer">
            <label>Svar:</label>
            {#if question.type === "timeline"}
                <p>Årståll:</p>
                {#each question.answer_time as point, i (i)}
                    {point.value},
                {/each}
            {/if}
            <strong>{question.answer?.text || question.answer}</strong>
            <br>
            <label>Riktig svar:</label>
            {#if question.type === "timeline"}
                <ul>
                    {#each question.items as option, i (i)}
                        <li style="list-style: upper-roman">{option.correctValue} - {option.label}</li>
                    {/each}
                </ul>
            {/if}

        </div>
        Poeng fått: {question._points}

    </Card>
    <br>
</div>


<style>
    .answer {
        margin-top: 5px;

    }

    label {
        border-bottom: 3px solid #A5D6D9;
        font-weight: bolder;
    }
</style>