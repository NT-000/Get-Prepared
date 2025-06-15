<script>
    import {currentUser} from "../../stores/userStore.js";
    import {score, currentGame, questionsAsked, questions_on_quiz} from "../../stores/gameStore.js"
    import SelectOption from "../../components/quizComponents/questions/SelectOption.svelte";
    import Button from "../../shared/Button.svelte";
    import H1 from "../../shared/H1.svelte";
    import {questionStore} from "../../stores/QuestionStore.js";
    import Paragraph from "../../shared/Paragraph.svelte";
    import ScoreCard from "../../components/quizComponents/highscore_components/ScoreCard.svelte";
    import QuestionCard from "../../components/quizComponents/questions/QuestionCard.svelte";
    import Categories from "../../components/Categories.svelte";

    let audio = new Audio('/relaxing.mp3')
    let audioQ = new Audio('/new_q.mp3')
    let audioWin = new Audio('/yey.mp3')
    let audioLose = new Audio('/sloppy.ogg')
    let question = $state({});
    let error_message = $state("")
    let gameStart = $state(false)


    let difficulty = $state("Alle")
    const difficulties = ['Alle', 'Lett', 'Medium', 'Vanskelig']
    let selectedCategories = $state([])


    let totalPoints = 0;
    let isNewGame = $state(true);

    $effect(() => {

        console.log("Valgte kategorier:", $state.snapshot(selectedCategories));
        console.log("isGameStart:", gameStart)
        console.log("isNewGame:", isNewGame)
    })

    const handleCategoriesChange = (newCategories) => {
        selectedCategories = newCategories;
    }
    const fetchFilteredQuestions = async () => {
        console.log("inside fetchQ")
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
                console.log("game start:", gameStart)
            } else {
                error_message = "Kunne ikke hente spørsmål..."
            }
        } catch {
            error_message = "Noe gikk galt under lasting av spørsmål.";
        }
    }

    console.log("currentUser", $currentUser)


    const pickQuestion = async () => {
        await audioQ.play()
        if ($questionsAsked >= $questionStore.length) {

            const new_score_object = {

                score: $score,
                gameType: $currentGame.gameType
            }
            console.log("Sending score object:", new_score_object);
            gameStart = false;
            isNewGame = false;
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
        console.log("SPØRSMÅL BESVART:", $questions_on_quiz)
        $questionStore.splice(index, 1);
    }


</script>


<div class="logged-in">
    {#if $currentUser && !gameStart}
        <H1>Velkommen til Quiz, {$currentUser.name}!</H1>
    {:else if !isNewGame}
        <H1>Din poengsum og svar</H1>
    {/if}
</div>

{#if gameStart}
    <QuestionCard {gameStart} {question} {audioWin} {audioLose} {pickQuestion}/>
{/if}
{#if !isNewGame}
    <ScoreCard bind:isNewGame={isNewGame}/>
{/if}
{#if !gameStart && isNewGame}
    <div class="btn">
        <Paragraph>{error_message}</Paragraph>
        <H1><img src="/crown.png" style="height: 250px; width: 250px" alt="img-crown"></H1>
        <Paragraph>Velg spilltype</Paragraph>
        <SelectOption/>
        <div>
            <select bind:value={difficulty}>
                {#each difficulties as level, i (i)}
                    <option>
                        {level}
                    </option>
                {/each}
            </select>
        </div>
        <Categories onChange={handleCategoriesChange}/>
        {#if isNewGame}
            <Button type="button" on:click={fetchFilteredQuestions} text="Start nytt spill"/>
        {/if}
    </div>

{/if}

<style>


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


</style>
