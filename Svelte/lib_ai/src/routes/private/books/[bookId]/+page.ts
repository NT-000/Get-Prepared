import type {PageLoad} from './$types';
import {error} from "@sveltejs/kit";

export const load: PageLoad = async ({parent, params}) => {
    const {supabase} = await parent();

    const bookId = Number(params.bookId);

    const {data} = await supabase.from("books").select("*").eq("id", bookId).single();

    if (data) {
        return {book: data}
    }

    return error(404, "Not Found")
};