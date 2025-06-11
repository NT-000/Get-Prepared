<script>
    export let text;
</script>

<h1>
    <slot>{text}</slot>
</h1>

<style>
    h1 {
        font-family: 'Segoe UI', 'Helvetica Neue', sans-serif;
        font-size: 2rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 1rem;
        text-align: center;
        border-bottom: 5px solid #0077ff;
        border-radius: 5px;
        display: inline-block;
        padding-bottom: 3px;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
    }
</style>

