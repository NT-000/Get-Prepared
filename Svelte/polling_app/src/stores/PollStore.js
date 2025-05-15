import { writable} from 'svelte/store';

const PollStore = writable([
    {
        id:1
        ,question: 'Test?'
        ,answer_a: 'Ja!'
        ,answer_b: 'Nei'
        ,votesA: 1
        ,votesB: 10
    },

    {
        id:2
        ,question: 'Test2?'
        ,answer_a: 'Ja!'
        ,answer_b: 'Nei'
        ,votesA: 23
        ,votesB: 25
    },

]);

export default PollStore;
