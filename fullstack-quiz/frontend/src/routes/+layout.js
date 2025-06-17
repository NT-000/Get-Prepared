import {redirect} from '@sveltejs/kit';


const publicPaths = ['/login', '/new_user', '/highscores'];

export async function load({fetch, url}) {

    const path = url.pathname
    const res = await fetch('/api/logged_in_user', {
        credentials: 'include'
    });
    const payload = await res.json();


    if (!payload.success && !publicPaths.includes(path)) {
        throw redirect(302, '/login');
    }


    return {
        user: {
            id: payload.id,
            username: payload.username,
            name: payload.name
        }
    }
}
