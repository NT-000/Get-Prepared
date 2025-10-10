<script lang="ts">
	import CourseCard from '../../components/CourseCard.svelte';
	import type { Session } from '@supabase/supabase-js';

	let { data } = $props();

	const courses = $derived(data.courses ?? []);

	const session: Session | undefined = data.session ?? undefined;

	console.log('Courses page data:', data);

</script>

<main>

	<h1>Kurs du kan ta</h1>
	<div class="course-container">
		<div class="courses">
			<ul>
				{#each courses as course (course.id)}
					<CourseCard {course} session={session} />
				{/each}
			</ul>
		</div>
		<div class="course-info">

		</div>
	</div>
</main>

