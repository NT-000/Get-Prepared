import { redirect } from '@sveltejs/kit';
import {currentUser, guest} from "../../stores/userStore.js";
import {get} from "svelte/store";

export async function load({ fetch }) {

    const user = get(currentUser);
    const guestUser = get(guest)
    if (!user && !guestUser) {
    throw redirect(302, '/login');
    }

    const res = await fetch('/api/questions',{
        credentials: 'include'
    })
    const questions = await res.json();
    return {questions};
}



