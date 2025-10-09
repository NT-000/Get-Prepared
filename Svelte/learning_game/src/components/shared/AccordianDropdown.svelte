<script lang="ts">

	import Icon from '@iconify/svelte';

	let { isOpen = false } = $props<{ isOpen?: boolean }>();


</script>
<div class="icon">
	{#if isOpen}
		<Icon icon="solar:alt-arrow-up-line-duotone" width="40" />
	{:else}
		<Icon icon="solar:alt-arrow-down-line-duotone" width="40" />
	{/if}
</div>
<style>
    .icon {
        display: inherit;
        justify-content: flex-end;
        align-items: center;
				
    }
</style>

