<script lang="ts">

    import Icon from "@iconify/svelte";
    import {type Book, getUserState} from "../state/user-state.svelte"

    interface StarRatingProps {
        book: Book,
        updateDatabaseRating?: (updatedRating: number) => void;
    }


    let {updateDatabaseRating, book}: StarRatingProps = $props();

    let currentRating = $state(book.rating ?? 0)

    async function handleRating(updatedRating: number) {
        currentRating = updatedRating;
        if (updateDatabaseRating) {
            updateDatabaseRating(updatedRating)
            console.log("update1");
        } else {
            console.log("else, error");
        }
    }


</script>


<div class="rating">
    <div class="rating-container">
        {#each Array(5) as _, i (i)}

            <button class="star" class:active={currentRating > i} onclick={() => handleRating(i + 1)}>
                <Icon
                        icon="famicons:star"
                        color={currentRating > i ? "gold" : "black"}
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

    @keyframes pulse {
        0% {
            transform: scale(0.9);
        }
        50% {
            transform: scale(1.1);
        }
        100% {
            transform: scale(1);
        }
    }

    .star.active {
        animation: pulse 1.5s ease-in-out infinite;
        transform-origin: center;
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