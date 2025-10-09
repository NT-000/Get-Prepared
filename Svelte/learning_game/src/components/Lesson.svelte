<script lang="ts">
	import type { LessonProps } from '../types/course-tree';
	import Button from './shared/Button.svelte';
	import AccordianDropdown from './shared/AccordianDropdown.svelte';

	const { session, lesson } = $props<{ lesson: LessonProps }>();

	console.log('session course-page:', session);

	let isOpen = $state(false);


</script>

<section>


	<Button onclick={() =>isOpen = !isOpen} isDropdown={true}>
			<span>{lesson.order_index}.{lesson.title}
				{#if isOpen && session}
						<AccordianDropdown isOpen={isOpen} />
							<div>{lesson.content_json.blocks}</div>
						{/if}
				</span>
	</Button>


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