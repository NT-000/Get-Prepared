<script>
    export let showModal;
    export let isPremium;


</script>

{#if showModal}
<div class="backdrop" on:click|self>
 <div class="modal" class:isPremium = {isPremium}>
<slot>

</slot>
 </div>
</div>
    {/if}

<style>

    .backdrop{
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.8);
        position: fixed;
        top: 0;
        left: 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .modal{
        background: white;
        padding: 20px;
        border-radius: 10px;
        max-width: 400px;
        margin: 10% auto;
        text-align: center;
        z-index: 2;
    }
    .isPremium{
        background: white;
        padding: 20px;
        border-radius: 10px;
        border: gold solid 2px;
        max-width: 400px;
        margin: 10% auto;
        text-align: center;
        transform: scale(1.2);
        color: gold;
    }
</style>