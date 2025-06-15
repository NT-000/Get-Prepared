<script>
    import Card from "../../../shared/Card.svelte";

    export let question;
    export let isOpen = false

</script>


<div>
    <Card correct={question.points > 0} wrong={question.points === 0} active={isOpen} bind:isOpen>

        <div class="question">{question.question}</div>
        {#if isOpen}
            <div class="answer">
                <label>Svar:</label>
                {#if question.type === "timeline"}

                    {#each question.answer_time as point, i (i)}
                        <li>
                            {point.value} - {point.label}
                        </li>
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
        {/if}

    </Card>
    <br>
</div>


<style>
    .answer {
        margin-top: 5px;

    }


    strong {
        font-style: italic;

    }

    label {
        font-weight: bolder;
        margin-bottom: 20px;
    }
</style>