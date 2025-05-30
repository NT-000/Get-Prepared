
export async function load({fetch}){
    const res = await fetch('/api/scores', {
        credentials: 'include'
    })
    const highscores = await res.json()

    return  {highscores}
}