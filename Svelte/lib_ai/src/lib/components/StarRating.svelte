<script lang="ts">

    import Icon from "@iconify/svelte";

    let {book} = $props();
</script>


<div class="rating mt-s">
    Rating:
    {#each Array(book.rating) as _, i}
        <Icon icon="famicons:star-sharp" style="color: gold"/>
    {/each}
    {#each Array(5 - (book?.rating ?? 0)) as _, i}
        <Icon icon="famicons:star" style="color: white"/>
    {/each}
</div>

<style>

    .rating {
        display: flex;
    }
</style>