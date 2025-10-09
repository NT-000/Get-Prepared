<script lang="ts">

	import Lesson from './Lesson.svelte';
	import type { ModuleProps } from '../types/course-tree';
	import Button from './shared/Button.svelte';
	import AccordianDropdown from './shared/AccordianDropdown.svelte';


	let { mod, session } = $props<{ mod: ModuleProps; session?: any }>();


	let isOpenLesson = $state(false);

</script>

<section>

	<Button onclick={() => (isOpenLesson = !isOpenLesson)} isDropdown={true}>
		<span>{mod.title}</span>
		{#if session && mod.description}
			<span>{mod.description}
				<AccordianDropdown isOpen={isOpenLesson} /></span>
		{/if}
	</Button>


	{#if isOpenLesson}
		<ul>
			<li>
				{#each (mod.lessons ?? []) as lesson (lesson.id)}
					<Lesson {lesson} {session} />
				{/each}
			</li>
		</ul>
	{/if}
</section>
<style>

    li {
        list-style: none;
    }

    ul {
        margin: 0;
        padding: 0;
    }

    section {
        border-bottom: 3px solid #ededed;
        width: 400px;
    }

    section:last-child {
        border-bottom: none;
    }
</style>