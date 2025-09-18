<script lang="ts">

    const {children} = $props()

</script>

<div class="spinner-container">
    {@render children()}
    <div class="spinner">
    </div>
</div>


<style>

    .spinner {
        display: flex;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }

    .spinner {
        display: inline-block;
        animation: spin 1s infinite linear;
        border-radius: 50%;
        border: 4px solid rgba(0, 0, 0, 0.2);
        border-right-color: black;
        width: 40px;
        height: 40px;
        cursor: progress;
    }
</style>