<script>

    export let items;
    export let activeItem;


</script>

<main>
    <div class="tabs">
        <ul>
        {#each items as item}
            <li on:click={() => activeItem = item}>
               <div class:active={item === activeItem}>{item}</div>
            </li>
        {/each}
        </ul>
    </div>
</main>

<style>
.active {
    color: red;
    font-weight: bold;
    border-bottom: 2px solid red;
    padding-bottom: 8px;
}
.tabs{
    margin-bottom: 40px;
}
ul{
    display: flex;
    justify-content: center;
    list-style: none;
    padding: 0;
}
li{
    margin: 0 10px;
    cursor: pointer;
    color: #555;
}
</style>
