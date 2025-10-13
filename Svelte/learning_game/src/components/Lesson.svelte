<script lang="ts">
	import type { LessonProps } from '../types/course-tree';
	import Button from './shared/Button.svelte';
	import type { Session } from '@supabase/supabase-js';


	const { session, lesson, isOpen = false, onToggle } = $props<{
		lesson: LessonProps;
		isOpen?: boolean;
		onToggle?: () => void;
		session: Session
	}>();

	console.log('session course-page:', session);


</script>

<section>


	<Button onclick={onToggle} isExpanded={isOpen} isDropdown={true}>
		<span class="button-content">
			<span class="title">{lesson.title}</span>
		</span>
	</Button>

	{#if isOpen && session}
		<div class="lesson-content">
			{#if lesson.tasks && lesson.tasks.length > 0}
				<div class="tasks-list">
					{#each lesson.tasks as task (task.id)}
						<Button href={`/private/tasks/${task.id}`} isMenu={true}>
							<span class="task-item">
								<span class="task-prompt">{task.prompt}</span>
								<span class="task-points">{task.points} poeng</span>
							</span>
						</Button>
					{/each}
				</div>
			{:else}
				<p>Ingen oppgaver tilgjengelig ennå.</p>
			{/if}
		</div>
	{/if}


</section>

<style>

    .lesson-content {
        padding: 1rem;
        margin-left: 2rem;
    }

    .tasks-list {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .task-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        font-size: 16px;
    }

    .task-prompt {
        flex: 1;
        text-align: left;
    }

    .task-points {
        font-weight: bold;
        color: #4a5568;
        margin-left: 1rem;
    }

    .button-content {
        width: 100%;
        font-size: 20px !important;
    }
</style>