import {redirect, type RequestHandler} from "@sveltejs/kit";

export const GET: RequestHandler = async ({url, locals: {supabase}}) => {

    const code = url.searchParams.get("code")
    if (code) {
        await supabase.auth.exchangeCodeForSession(code)
    }

    const sessionData = await supabase.auth.getSession();

    const userData = await supabase.auth.getUser();

    if (sessionData.data.session) {
        console.log(userData)
        const userId = sessionData.data.session.user.id;
        const username = sessionData.data.session.user.user_metadata.name;

        console.log("name:", username)

        const {data: existingUser, error: selectError} = await supabase
            .from("user_names").select("name").eq("user_id", userId).single();
        if (selectError && selectError.code !== "PGRST116") {
            return new Response("Failed to check for existing user", {status: 500})
        }
        if (!existingUser) {
            const {error: insertError} = await supabase.from("user_names").insert([
                {
                    user_id: userId,
                    name: username
                }
            ])
            if (insertError) return new Response("Failed to insert username", {status: 500})
        }

        throw redirect(303, "/private/dashboard")
    }
    return new Response("Session data not found.", {status: 400})
}