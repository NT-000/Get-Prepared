<script>
    export let typeBtn = 'primary'
    export let text = ""
    export let type = "text"
    export let value;
</script>

<input class="{typeBtn}" type="{type}" placeholder="{text}" bind:value on:blur/>

<style>
    .primary {
        background-color: #ffffff;
        color: #333;
        margin: 12px 0;
        padding: 12px 16px;
        border-radius: 8px;
        font-weight: 500;
        font-family: 'Segoe UI', 'Helvetica Neue', sans-serif;
        font-size: 1rem;
        border: 1px solid #ccc;
        transition: all 0.2s ease-in-out;
        width: 100%;
        box-sizing: border-box;
        text-shadow: 1px 2px 3px rgba(0, 0, 0, 0.3);
    }

    .primary:focus {
        border-color: #0077ff;
        box-shadow: 0 0 0 2px rgba(0, 119, 255, 0.2);
        outline: none;
    }


    .secondary {
        background-color: #f1f1f1;
        color: #666;
        border: 1px solid #aaa;
    }
</style>