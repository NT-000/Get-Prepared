<script>
    export let correct = false
    export let wrong = false
    export let active = false
    export let isOpen = false

    const toggle = () => {
        isOpen = !isOpen
    }
</script>

<div class="card" class:correct={correct} class:wrong={wrong} class:active={active} class:hoverable={!active}
     onclick={toggle}>
    <slot></slot>
</div>

<style>
    .card {
        background-color: white;
        padding: 20px;
        border-radius: 6px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        width: 100%;
        transition: background-color 0.2s ease;
        cursor: pointer;
    }

    .card.correct {
        background-color: #36d399;

    }

    .card.wrong {
        background-color: #f87171;

    }

    .card.active {
        border: 2px solid #007acc;
    }

    .card.hoverable:hover {
        background-color: lightblue;
    }
</style>