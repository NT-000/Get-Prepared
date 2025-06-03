import { redirect } from '@sveltejs/kit';
import {currentUser, guest} from "../../stores/userStore.js";
import {get} from "svelte/store";

export async function load() {

    const user = get(currentUser);
    const guestUser = get(guest)
    if (!user && !guestUser) {
    throw redirect(302, '/login');
    }
return{}
}



