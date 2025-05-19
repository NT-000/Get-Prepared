<script>
    export let question;
    export let handleAnswer;
</script>


<ul style="list-style-type: none">
            {#each question.options as option}
               <li on:click={() => handleAnswer(option, question)}>{option.text}</li>
            {/each}
        </ul>

<style>
        li:hover{
        cursor: pointer;
        background-color: #eee;
        width: 100%;
        height: 100%;
    }
    li{
        margin: 10px;
        font-family: comic sans ms,serif;
        font-size: 1.5em;
    }
</style>