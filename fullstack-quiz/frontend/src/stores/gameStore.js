import {writable} from "svelte/store";

export let gameTypes = writable([{'gameType':'Kort - 10 spørsmål', 'questions': 10}, {'gameType':'Medium - 20 spørsmål', 'questions': 20}, {'gameType':'Lang - 30 spørsmål', 'questions': 30}])
export let currentGame = writable({'gameType':'Kort - 10 spørsmål', 'questions': 10})
export const score = writable(0);
export let questionsAsked = writable(0)
export let questions_on_quiz = writable([])