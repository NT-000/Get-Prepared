<script lang="ts">

    import Icon from "@iconify/svelte";

    let {book} = $props();
</script>


<div class="rating mt-s">
    {#if book.rating !== null}
        {#each Array(book.rating) as _, i}
            <Icon icon="famicons:star-sharp" style="color: gold"/>
        {/each}
        {#each Array(5 - (book?.rating ?? 0)) as _, i}
            <Icon icon="famicons:star" style="color: white"/>
        {/each}
    {:else}
        <p>Not rated yet</p>
    {/if}
</div>

<style>

    .rating {
        display: flex;
        font-size: 40px;
        border: none;
        outline: none;
        background: none;
        padding: 0;
        color: transparent;
    }
</style>