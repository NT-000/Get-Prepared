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

    const updateTimer = () => {
        const now = Date.now();
        console.log("now:", now)
        count = Math.max(0, Math.round((end - now) / 1000));
        console.log("count:", count)
        h = Math.floor(count / 3600);
        m = Math.floor((count % 3600) / 60);
        s = count % 60;
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
        if (data.endTimestamp) {
            end = data.endTimestamp
            console.log("data.endTimestamp hit:", end)
        } else {
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

    .hour, .minutes, .seconds {
        background-color: black;
        color: white;
        padding: 20px 30px;
        border-radius: 8px;
        font-weight: bold;
        min-width: 80px;
        text-align: center;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
