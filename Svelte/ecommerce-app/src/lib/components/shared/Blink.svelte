<script>
	const {children} = $props()
</script>

<div class="blink">
	{@render children()}
</div>

<style>
    .blink {
        animation: blink 1s linear infinite;
    }
    @keyframes blink {
        50% {
            opacity: 0;
        }
    }
</style>