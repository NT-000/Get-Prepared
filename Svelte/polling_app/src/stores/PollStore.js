import { writable} from 'svelte/store';

const PollStore = writable([
    {
        id:1
        ,question: 'Login process = true?'
        ,answer_a: 'Yes'
        ,answer_b: 'No'
        ,votesA: 5
        ,votesB: 10
    },
]);

export default PollStore;
