
export async function load({ fetch }) {
    const res = await fetch('/api/questions');
    const questions = await res.json();
    return { questions };
}