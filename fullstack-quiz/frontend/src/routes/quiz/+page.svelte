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


<div class="container">
    <div class="logged-in">
        {#if $currentUser && !gameStart}
            <H1>Er du klar for the loop, {$currentUser.name}?</H1>
        {/if}
    </div>
    {#if gameStart}
        <QuestionCard {gameStart} {question} {audioWin} {audioLose} {pickQuestion}/>
    {/if}
    {#if !isNewGame}
        <H1>Din poengsum og svar</H1>
        <Paragraph>{error_message}</Paragraph>
        <ScoreCard bind:isNewGame={isNewGame}/>
    {/if}
    {#if !gameStart && isNewGame}
        <div class="game-container">

            <p>Har du det som trengs? - Dr Dean</p>
            <H1><img src="/dr.png" style="height: 250px; width: 250px" alt="logo"></H1>
            <Paragraph>Lengde på quizen🧠</Paragraph>
            <SelectOption/>
            <div class="difficulty-select">
                <Paragraph>Vanskelighetsgrad💡</Paragraph>
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
</div>
<style>


    .container {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 36px auto 0 auto;
        gap: 16px;
        background-color: #f2f6fc;
        padding: 30px 14px;
        border-radius: 16px;
        max-width: 750px;
        border: 1.5px solid #e1e9f0;
        box-shadow: 0 2px 12px rgba(20, 60, 100, 0.05);
        width: 95vw;
    }

    .logged-in {
        text-align: center;
        margin-bottom: 6px;
    }

    .game-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
        max-width: 420px;
        background: #fff;
        padding: 26px 14px 18px 14px;
        border-radius: 12px;
        border: 2px solid #e1e9f0;
        box-shadow: 0 1px 8px rgba(50, 80, 130, 0.04);
        gap: 18px;
        margin-top: 10px;
    }

    .difficulty-select {
        width: 100%;
        text-align: center;
        margin-top: 0;
    }

    select {
        border-radius: 7px;
        border: 1px solid #b8c6d4;
        padding: 10px;
        width: 100%;
        max-width: 210px;
        font-size: 1rem;
        margin-top: 6px;
        background: #f7fafc;
        transition: border 0.17s;
    }

    select:focus {
        outline: none;
        border: 1.5px solid #40a9ff;
        background: #eaf6ff;
    }

    option {
        padding: 8px;
    }


</style>
