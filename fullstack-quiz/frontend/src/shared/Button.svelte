<script>

export let type = 'primary'
export let flat = false;
export let inverse = false;
export let text;
</script>

<button class="{type}" class:flat={flat} class:inverse={inverse} on:click>
    <slot>{text}</slot>
</button>

<style>

    button{
        border: 0;
        cursor: pointer;
        border-radius: 6px;
        padding: 8px 12px;
        font-weight: bold;
        box-shadow: 1px 2px 3px rgba(0,0,0,0.2);
    }
.primary{
    background-color: red;
    color: #ffffff;
}
.secondary{
    background-color: #45c496;
    color: #ffffff;
}
.flat{
box-shadow: none;
}
primary.inverse{
    background-color: white;
    color: red;
    border: 2px solid red;

}
secondary.inverse{
    background-color: #ffffff;
    color: #45c496;
    border: 2px solid #45c496;
}
</style>