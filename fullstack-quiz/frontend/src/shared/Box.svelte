<div class="box">
    <slot/>
</div>

<style>
    .box{
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin: 10px;
        padding: 10px;
        border: 1px solid black;
        border-radius: 5px;
        width: 50%;
        height: 50%;
        text-align: center;
    }
</style>