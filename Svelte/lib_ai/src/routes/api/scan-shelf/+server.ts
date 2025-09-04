import {json, type RequestHandler} from "@sveltejs/kit";
import OpenAI from "openai";
import {OPEN_AI_KEY} from "$env/static/private";

const openai = new OpenAI({
    apiKey: OPEN_AI_KEY,
});

export const POST: RequestHandler = async ({request}) => {


    const {base64} = await request.json()

    const response = await openai.responses.create({
        model: "gpt-4o-mini",

        input: [
            {
                role: "user",
                content: [
                    {
                        type: "input_text",
                        text: `Extract books from the image provided and return them as JSON. What I need is the information in this format: 
                        {
                        "bookTitle": "Thinking, Fast and Slow",
                        "author": "Daniel Kahneman",
                        "description": "A book about human decision-making and the two systems in the brain.",
                        "genre": "Psychology",
                        }
                        Please also make sure you return an array, even if there is only one book visible on the image.`,
                    },
                    {
                        type: "input_image",
                        image_url: `data:image/jpeg;base64,${base64}`,
                        detail: "low"
                    },
                ],
            },
        ],
    });

    const booksArrayString = response.output_text.replace(/```json|```/g, "").trim();
    const bookArray = JSON.parse(booksArrayString || "")

    console.log("Response:", bookArray)
    return json({success: true, bookArray});
}