import type {PageLoad} from './$types';

import {error} from "@sveltejs/kit";


export const load: PageLoad = async ({parent, params}) => {

    const {supabase} = await parent()

    const userId = params.userId
    if (!userId) {
        throw error(404, "userId not found");
    }

    console.log("param:", params)


    const {
        data: profile,
        error: profileError
    } = await supabase.from("user_names").select("user_id, name").eq("user_id", userId).single()

    if (profileError) {
        throw error(404, "couldn't find user")
    }
    const {
        data: books,
        error: bookError
    } = await supabase.from("books").select("id, title, author, cover_img, rating, started_reading, finished_read").eq("user_id", userId)

    if (bookError) {
        throw error(404, "couldn't fill book array");
    }

    console.log("publicUser:")


    return {profile, books: books ?? []}
};