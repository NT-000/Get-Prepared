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
        {/if}
    </div>


</main>

<style>
    main {
        display: flex;
        flex-direction: column;
        align-items: center;
        min-height: 280px;
        margin-top: 30px;
    }

    .countdown-clock {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 20px;
        background: linear-gradient(120deg, #e9f4fd 0%, #f9faff 100%);
        padding: 32px 38px;
        border-radius: 24px;
        border: none;
        box-shadow: 0 2px 24px 0 rgba(80, 130, 230, 0.10);
        font-size: 1.5rem;
        flex-wrap: wrap;
        margin: 20px 0;
        min-width: 320px;
        transition: box-shadow 0.2s;
    }

    .countdown-clock:hover {
        box-shadow: 0 6px 40px 0 rgba(80, 130, 230, 0.16);
    }

    .time-block {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 1px 8px 0 rgba(120, 150, 255, 0.07);
        padding: 14px 18px 10px 18px;
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 0 4px;
        min-width: 72px;
        transition: transform 0.15s;
    }

    .value {
        font-size: 2.3rem;
        font-weight: 700;
        color: #3477eb;
        letter-spacing: 1px;
        line-height: 1.1;
        animation: pop 0.25s;
    }

    .label {
        font-size: 1rem;
        color: #8aa7c2;
        margin-top: 3px;
        font-weight: 500;
        letter-spacing: 0.5px;
    }

    @keyframes pop {
        0% {
            transform: scale(1.2);
        }
        70% {
            transform: scale(0.97);
        }
        100% {
            transform: scale(1);
        }
    }

    strong {
        font-size: 1.1rem;
        color: #29519a;
        letter-spacing: 1px;
        margin-top: 18px;
    }

</style>
