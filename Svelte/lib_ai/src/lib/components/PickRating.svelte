<script lang="ts">

    import Icon from "@iconify/svelte";

    interface StarRatingProps {
        value: number,
        updateDatabaseRating?: (updatedRating: number) => void;
    }

    let {value, updateDatabaseRating}: StarRatingProps = $props();

    function handleRating(updatedRating: number) {
        value = updatedRating;
        if (updateDatabaseRating) {
            updateDatabaseRating(updatedRating)
        }
    }
</script>


<div class="rating">
    Rating:
    <div class="rating-container">
        {#each Array(5) as _, i}
            <button class="star" onclick={() => handleRating(i + 1)}>
                <Icon
                        icon="famicons:star"
                        color={value > i ? "gold" : "black"}
                        width="40"
                />
            </button>
        {/each}
    </div>
</div>

<style>


    .rating-container {
        display: inline-flex;
        outline: none;
    }


    .star {
        border: none;
        outline: none;
        background: none;
        cursor: pointer;
        padding: 0;
        color: transparent;
        font-size: 40px;
    }

    .star:hover {
        transform: scale(1.3);
    }


</style>