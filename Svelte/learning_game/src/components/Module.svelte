<script lang="ts">

	import Lesson from './Lesson.svelte';
	import type { ModuleProps } from '../types/course-tree';
	import Button from './shared/Button.svelte';
	import AccordianDropdown from './shared/AccordianDropdown.svelte';


	const { mod } = $props<{ mod: ModuleProps }>();

	let isOpenLesson = $state(false);

</script>

<section>

	<Button onclick={() => (isOpenLesson = !isOpenLesson)} isDropdown={true}>
		<span>{mod.order_index}.{mod.title}</span>
		<span>{mod.description}</span>

		<AccordianDropdown isOpen={isOpenLesson} />

	</Button>


	{#if isOpenLesson}
		<ul>
			{#each (mod.lessons ?? []) as lesson (lesson.id)}
				<Lesson {lesson} />
			{/each}
		</ul>
	{/if}
</section>
<style>

</style>