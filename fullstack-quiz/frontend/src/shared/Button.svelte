<script>

export let class_type = 'primary'
export let type = "submit"
export let flat = false;
export let inverse = false;
export let text;

</script>

<button type="{type}" class="{class_type}" class:flat={flat} class:inverse={inverse} on:click>
    <slot>{text}</slot>
</button>

<style>

    button{
        border: none;
    cursor: pointer;
    border-radius: 8px;
    padding: 12px 18px;
    font-weight: 600;
    font-size: 1rem;
    font-family: 'Segoe UI', 'Helvetica Neue', sans-serif;
    transition: all 0.2s ease-in-out;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
.primary{
    background-color: #0077ff;
    color: #ffffff;
}
.primary:hover{
    background: gold;
}
.secondary{
    background-color: #45c496;
    color: #ffffff;
}
.secondary:hover {
    background-color: #369b79;
}
    button:hover {
    background-color: #005fcc;
}
.flat{
box-shadow: none;
}
.primary.inverse{
    background-color: #ffffff;
    color: #0077ff;
    border: 2px solid #0077ff;

}
.secondary.inverse{
    background-color: #ffffff;
    color: #45c496;
    border: 2px solid #45c496;
}
</style>