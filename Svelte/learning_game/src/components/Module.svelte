<script lang="ts">

	import Lesson from './Lesson.svelte';
	import type { ModuleProps } from '../types/course-tree';
	import Button from './shared/Button.svelte';
	import type { Session } from '@supabase/supabase-js';
	import { chevron } from '$lib';


	let { mod, session, isOpen = false, onToggle } = $props<{
		mod: ModuleProps;
		session?: Session;
		isOpen?: boolean;
		onToggle?: () => void;
	}>();

	let openLessonId = $state<string | null>(null);

	function toggleLesson(lessonId: string) {
		openLessonId = openLessonId === lessonId ? null : lessonId;
	}

</script>

<section>

	<Button onclick={onToggle} isDropdown={true} isExpanded={isOpen}>
		<span class="button-content">
			<span class="title">{mod.title}</span>
			<img src={chevron} alt="drop-down-chevron" class="chevron" />
		</span>
	</Button>


	{#if isOpen}
		<ul>

			{#each (mod.lessons ?? []) as lesson (lesson.id)}
				<li>
					<Lesson {lesson} {session} isOpen={openLessonId === lesson.id}
									onToggle={() => toggleLesson(lesson.id)} />
				</li>
			{/each}

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

    img {
        width: 10%;
        transition: transform 0.3s ease;
        display: inline-block;
    }
</style>