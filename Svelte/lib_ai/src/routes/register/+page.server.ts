import type {Actions} from "./$types";
import {fail, redirect} from "@sveltejs/kit";

interface ReturnObject {
    success: boolean;
    errors: string[];
    name: string;
    email: string;
    password: string;
    confirmPassword: string;

}

export const actions: Actions = {
    default: async ({request, locals: {supabase}}) => {
        const formData = await request.formData()
        const name = formData.get("name") as string;
        const email = formData.get("email") as string;
        const password = formData.get("password") as string;
        const confirmPassword = formData.get("confirmPassword") as string;

        const returnObject: ReturnObject = {
            success: true,
            errors: [],
            name,
            email,
            password,
            confirmPassword,
        }

        if (name.length < 3) {
            returnObject.errors.push("Name is too short, it needs to be at least 3 characters.");
        }
        if (password.length < 6) {
            returnObject.errors.push("Password need to be 6 or more characters.")
        }
        if (confirmPassword !== password) {
            returnObject.errors.push("The passwords don't match.")
        }
        if (email.length < 10) {
            returnObject.errors.push("Email address is too short.")
        }
        if (!email.includes("@") || !email.includes(".")) {
            returnObject.errors.push("Email address needs to have an '@' and '.'")
        }

        if (returnObject.errors.length) {
            returnObject.success = false;
            return returnObject;
        }


        const response = await supabase.auth.signUp({
            email,
            password,
        })
        if (response.error || !response.data.user) {
            console.error("Error occurred")
            console.error(response.error)
            returnObject.success = false;
            return fail(400, returnObject)
        }

        const userId = response.data.user.id;
        await supabase.from("user_names").insert([
            {
                user_id: userId,
                name,
            }
        ])

        redirect(303, "/private/dashboard")
    }
}