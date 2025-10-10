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
			{lesson.content_json.blocks}
		</div>
	{/if}


</section>

<style>

    li {
        font-size: inherit;
        font-style: italic;
        list-style: none;
        display: flex;
        width: 400px;
        text-align: center;
        margin: 0;
    }

    .lesson-content {
        font-size: 15px;
        font-weight: bold;
        font-style: italic;
        margin: inherit;
        padding: inherit;
    }

    img {
        width: 10%;
        transition: transform 0.3s ease;
        display: inline-block;
    }

    .button-content {
        width: 100%;
        font-size: 20px !important;
    }
</style>