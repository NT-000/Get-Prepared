<script lang="ts">

	import Icon from '@iconify/svelte';

	let { isOpen = false } = $props<{ isOpen?: boolean }>();


</script>

{#if isOpen}
	<Icon icon="solar:alt-arrow-up-line-duotone" width="40" />
{:else}
	<Icon icon="solar:alt-arrow-down-line-duotone" width="40" />
{/if}

