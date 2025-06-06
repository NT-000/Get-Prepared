<script>
    import Card from "../../shared/Card.svelte";
    import {currentUser, guest} from "../../stores/userStore.js";
    import {score, gameTypes, currentGame, questionsAsked, questions_on_quiz} from "../../stores/gameStore.js"
    import SliderQuestion from "../../components/SliderQuestion.svelte";
    import TimelineQ from "../../components/TimelineQ.svelte";
    import {goto} from "$app/navigation";
    import SliderInterval from "../../components/SliderInterval.svelte";
    import SelectOption from "../../components/SelectOption.svelte";
    import Button from "../../shared/Button.svelte";
    import H1 from "../../shared/H1.svelte";
    import {questionStore} from "../../stores/QuestionStore.js";
    import Paragraph from "../../shared/Paragraph.svelte";
    import ScoreCard from "../../components/ScoreCard.svelte";
    import NormalQuestion from "../../components/NormalQuestion.svelte";

    let audio = new Audio('/relaxing.mp3')
    let audioQ = new Audio('/new_q.mp3')
    let question;
    let error_message = ''
    let gameStart = false
    let isOpen = false;
    let difficulty = 'Alle'
    const difficulties = ['Alle', 'Lett', 'Medium', 'Vanskelig']
    let selectedCategories = []
    let categories = ['Sport', 'Naturvitenskap', 'Historie', 'Musikk', 'Mat og drikke', 'Kunst og kultur', 'Vitenskap', 'Film', 'Geografi', 'Litteratur', 'Samfunn', 'Astronomi', 'Teknologi', 'Filosofi', 'Miljø']
    let totalPoints = 0;
    let isNewGame = true;

    $:console.log("vanskelighetsgrad:", difficulty)
    $:console.log("VALGTE KATERGORIER:", selectedCategories)
    $:console.log("antall spørsmål", $questionsAsked)
    $:console.log("spørsmål:", $questionStore)

    $: console.log("isNewGame bool:", isNewGame)

    const logOut = async () => {
        try {
            const res = await fetch(`/api/logout`, {
                method: 'POST',
                credentials: 'include',
            });
            if (res.ok) {
                currentUser.set(null);
                guest.set(null);
                await goto("/login")
            } else {
                console.error('utlogging feilet');
            }
        } catch {
            console.error('noe gikk galt ved utlogging')
        }
    }

    const toggleCat = () => {
        isOpen = !isOpen
    }

    const fetchFilteredQuestions = async () => {
        await audio.play()
        audio.loop = true;
        try {
            if (difficulty === "Lett") {
                difficulty = "easy"
            } else if (difficulty === "Medium") {
                difficulty = "medium"
            } else if (difficulty === "Vanskelig") {
                difficulty = "hard"
            } else {
                difficulty = ""
            }
            const res = await fetch('/api/questions/filtered', {
                method: 'POST',
                credentials: "include",
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    "categories": selectedCategories,
                    "difficulty": difficulty
                })
            });
            if (res.ok) {
                const questions = await res.json()
                let shuffledQuestions = questions.sort(() => Math.random() - 0.5);
                $questionStore = shuffledQuestions.slice(0, $currentGame.questions);
                $questionsAsked = 0
                $score = 0
                totalPoints = 0
                await pickQuestion()
                gameStart = true
            } else {
                error_message = "Kunne ikke hente spørsmål..."
            }
        } catch {
            error_message = "Noe gikk galt under lasting av spørsmål.";
        }
    }

    console.log("guest:", $guest)
    console.log("currentUser", $currentUser)
    $: console.log("scoreStore: ", $score);


    const pickQuestion = async () => {
        await audioQ.play()
        if ($questionsAsked >= $questionStore.length) {

            const new_score_object = {
                username: ($currentUser || $guest).username,
                score: $score,
                gameType: $currentGame.gameType
            }
            console.log("Sending score object:", new_score_object);
            gameStart = false;
            error_message = "Spillet er over, din poengsum:" + $score + "/" + totalPoints;
            try {
                await fetch(`/api/scores`, {
                    method: "POST",
                    credentials: "include",
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(new_score_object)
                })
                audio.pause()
                audio.currentTime = 0;
                audio.loop = false;
            } catch {
                console.error("error")
            }
            return;
        }

        const index = Math.floor(Math.random() * $questionStore.length)
        question = $questionStore[index];
        totalPoints += question?.points;
        console.log("spørsmål fått:", $questions_on_quiz)
        $questionStore.splice(index, 1);

    }

    $: console.log("gametype:", $gameTypes)

</script>

{#if $currentUser || $guest}
    <div>
        <Button on:click={logOut} text="Logg ut"/>
    </div>  <!--Svelte 5 syntax for on:click = onclick-->

{/if}
<div class="logged-in">
    {#if $currentUser}
        <H1>Velkommen til Quiz, {$currentUser.name}!</H1>
    {:else if $guest}
        <H1>Velkommen til Quiz, {$guest.username}!</H1>
    {/if}
</div>
{#if gameStart}
    <div class="container">
        <Card>
            <h3>Dine poeng: {$score}</h3>
            <h3>Spørsmål igjen {$questionStore.length - $questionsAsked}</h3>
            <div class="form">
                {#if gameStart && question}
                    <br>
                    {#if question.type === 'normal'}
                        <NormalQuestion {question} {pickQuestion}/>
                    {:else if question.type === 'slider'}
                        <SliderQuestion {question} {pickQuestion}/>
                    {:else if question.type === 'timeline'}
                        <TimelineQ {question} {pickQuestion}/>
                    {:else if question.type === 'sliderInterval'}
                        <SliderInterval {question} {pickQuestion}/>
                    {/if}
                {/if}
            </div>
        </Card>
    </div>
{/if}
{#if !isNewGame}
    <ScoreCard bind:isNewGame={isNewGame}/>
{/if}
{#if !gameStart && isNewGame}
    <div class="btn">
        <Paragraph>{error_message}</Paragraph>
        <Paragraph>Velg spilltype</Paragraph>
        <SelectOption/>
        <div>
            <select bind:value={difficulty}>
                {#each difficulties as level, i (i)}
                    <option>{level}</option>
                {/each}
            </select>
        </div>
        <div class="cats" on:click={toggleCat}>Kategorier<img src="/fad--open.png"></div>
        {#if isOpen}
            <div class="categories-container">
                <div class="categories">
                    {#each categories as cat, i (i)}
                        <div class="category-item">
                            <input type="checkbox" value={cat} bind:group={selectedCategories}/>
                            <div class="label_cats">{cat}</div>
                        </div>
                    {/each}
                </div>
            </div>
        {/if}
        {#if isNewGame}
            <Button type="button" on:click={fetchFilteredQuestions} text="Start nytt spill"/>
        {/if}
    </div>

{/if}

<style>
    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 40px;
    }

    .form {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 32px;
        border-radius: 12px;
        width: 100%;
        max-width: 640px;
        background-color: #ffffff;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
        text-align: center;
        gap: 20px;
    }

    .categories {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 10px 20px;
        width: 100%;
        max-width: 600px;
    }

    .categories-container {
        background: white;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
        padding: 30px;
        gap: 10px;
    }

    .cats {
        font-weight: bolder;
        cursor: pointer;
    }

    .cats img:hover {
        border: #40a9ff;
        cursor: pointer;
        transform: scale(1.2);
    }

    .category-item {
        display: flex;
        align-items: center;
    }

    .label_cats {
        font-weight: 600;
        font-size: 1rem;
        margin-bottom: 6px;
        color: #444;
    }

    h3 {
        font-family: 'Segoe UI', 'Helvetica Neue', sans-serif;
        color: #2d2d2d;
        margin: 10px 0;
    }

    .btn {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 40px;
        gap: 20px;
        background: #ffffff;
        padding: 24px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .logged-in {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 40px;
    }

    select {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        border-radius: 10px;
        padding: 10px;
        width: 200px;
        text-align: center;
    }

    select:focus {
        background: lightblue;
    }

    option {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        border-radius: 10px;
    }

    input[type="checkbox"] {
        margin-right: 8px;
        margin-bottom: 10px;

    }

    input[type="checkbox"]:hover {
        transform: scale(1.2);
        background: lightblue;
        box-shadow: 0 4px 14px blue;
    }

</style>
