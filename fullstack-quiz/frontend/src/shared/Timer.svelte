<script>
    import {onMount, onDestroy} from 'svelte';
    import Button from "./Button.svelte";
    import LoadingWheel from "./LoadingWheel.svelte";

    export let count;

    let end = 0;
    let h = 0
    let m = 0
    let s = 0;
    let interval;
    let loading = true
    let hasDeleted = false


    async function deleteScores() {
        try {
            const res = await fetch('/api/scores', {
                method: 'DELETE',
                credentials: 'include'
            });
            const data = await res.json();
            console.log('deleted scores count', data.deleted_count);
        } catch (err) {
            console.error("could not delete highscores:", err);
        }
    }

    const updateTimer = () => {
        const now = Date.now();
        console.log("now:", now)
        count = Math.max(0, Math.round((end - now) / 1000));
        console.log("count:", count)
        h = Math.floor(count / 3600);
        m = Math.floor((count % 3600) / 60);
        s = count % 60;

        if (count <= 0 && !hasDeleted) {
            hasDeleted = true;
            deleteScores();
        }
    };

    const timeUpdate = async () => {
        try {
            const res = await fetch('/api/time', {
                method: "PUT",
                headers: {"Content-Type": "application/json"},
                body: JSON.stringify({endTimestamp: end})
            })
            if (res.ok) {
                console.log("countdown updated")
                await get_time()
            }
        } catch {
            console.error("update time didn't work")
        }
    }


    const get_time = async () => {
        const res = await fetch('/api/time');
        const data = await res.json();
        if (data.endTimestamp && Date.now() < data.endTimestamp) {
            end = data.endTimestamp
            console.log("data.endTimestamp hit:", end)
        } else {
            await deleteScores();
            end = Date.now() + data.countdown * 1000;

            await fetch('/api/time', {
                method: 'PUT',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({endTimestamp: end})
            });
            console.log("data.countdown:", end)
        }
        loading = false
        console.log('GET /api/time data:', data);
    };

    onMount(async () => {
        await get_time()
        updateTimer();
        interval = setInterval(updateTimer, 1000);
    });

    onDestroy(() => {
        clearInterval(interval);
    });
</script>
<svelte:window on:pagehide={timeUpdate}/> <!--  on:beforeunload -->
<main>

    {#if loading}
        <LoadingWheel text="Laster tid til sletting..."/>
    {/if}
    <div>
        {#if count > 0}

            <div class="countdown-clock">
                <div class="time-block">
                    <div class="value">{h}</div>
                    <div class="label">Timer</div>
                </div>
                <div class="time-block">
                    <div class="value">{m}</div>
                    <div class="label">Minutter</div>
                </div>
                <div class="time-block">
                    <div class="value">{s}</div>
                    <div class="label">Sekunder</div>
                </div>
            </div>


        {:else }
            <strong>Sletta alle poengsummene etter 24 timer!</strong>
            <br>
            <Button type="button" onclick={timeUpdate}>Oppdater tid</Button>
        {/if}
    </div>


</main>

<style>

    .countdown-clock {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        padding: 20px;
        border-radius: 10px;
        border: 3px solid black;
        background-color: white;
        font-size: 1.5rem;
        flex-wrap: wrap;
    }


    .time-block {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 0 10px;
    }

    .value {
        font-size: 2rem;
        font-weight: bold;
    }

    .label {
        font-size: 0.9rem;
        color: #ccc;
    }
</style>
