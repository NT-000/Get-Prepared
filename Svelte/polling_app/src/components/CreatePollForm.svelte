<script>
    import Button from '../shared/Button.svelte'
    import { createEventDispatcher } from 'svelte';
    const dispatch = createEventDispatcher();

    let fields =  {question: '', answer_a: '', answer_b: ''}
    let errors = {question: '', answer_a: '', answer_b: ''}
    let valid = false


    const submit = () => {
        valid = true
        if(fields.question.trim().length < 5) {
        errors.question = 'Question must be at least 5 characters long'
            valid = false
        }
        else{
            errors.question = ''
        }
        if(fields.answer_a.trim().length < 1) {
        errors.answer_a = 'Answer A must be at least 1 character long'
            valid = false
        }
        else{
            errors.answer_a = ''
        }
        if(fields.answer_b.trim().length < 1) {
        errors.answer_b = 'Answer B must be at least 1 character long'
            valid = false
        }
        else{
            errors.answer_b = ''
        }
        if(valid) {
           let poll = {...fields, votesA:0, votesB:0, id:Math.random()}
            dispatch('add', poll)
            fields = {question: '', answer_a: '', answer_b: ''}
            errors = {question: '', answer_a: '', answer_b: ''}
        }

    }
</script>

<main>
<form on:submit|preventDefault={submit}>
    <div class="form-field">
        <label for="question">Poll Question</label>
        <input type="text" id="question" bind:value={fields.question}>
        <div class="error">{errors.question}</div>
    </div>

    <div class="form-field">
        <label for="answer-a">Answer A</label>
        <input type="text" id="answer-a" bind:value={fields.answer_a}>
        <div class="error">{errors.answer_a}</div>
    </div>

    <div class="form-field">
        <label for="answer-b">Answer B</label>
        <input type="text" id="answer-b" bind:value={fields.answer_b}>
        <div class="error">{errors.answer_b}</div>
    </div>
    <Button type="secondary" flat={true}>Add Poll</Button>

</form>
</main>

<style>
.form-field {
    margin: 18px auto;
}
input{
    width: 100%;
    border-radius: 6px;
}
label{
    margin: 10px auto;
    text-align: left;
}
.error{
    color: red;
    font-size: 12px;
    font-weight: bold;
}
</style>