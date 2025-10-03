<script lang="ts">

	import Lesson from './Lesson.svelte';
	import type { ModuleProps } from '../types/course-tree';


	const { mod } = $props<{ mod: ModuleProps }>();

</script>

<section>

	<h3>{mod.order_index}.{mod.title}</h3>

	<p>{mod.description}</p>
	<ul>
		{#each (mod.lessons ?? []) as lesson (lesson.id)}
			<Lesson {lesson} />
		{/each}
	</ul>
</section>

<style>

</style>