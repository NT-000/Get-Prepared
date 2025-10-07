<script lang="ts">
	import type { LessonProps } from '../types/course-tree';
	import Button from './shared/Button.svelte';
	import AccordianDropdown from './shared/AccordianDropdown.svelte';

	const { lesson } = $props<{ lesson: LessonProps }>();

	let isOpen = $state(false);

</script>

<section>
	<ul>
		<li>
			<Button onclick={() =>isOpen = !isOpen} isDropdown={true}>{lesson.order_index}.{lesson.title}</Button>
			<AccordianDropdown isOpen={isOpen} />
		</li>
		{#if isOpen}
			<div>{lesson.content_json.blocks}</div>
		{/if}
	</ul>
</section>

<style>

    li {
        font-style: italic;
        list-style: none;
        display: flex;
        width: 300px;
        padding: 10px;
    }
</style>