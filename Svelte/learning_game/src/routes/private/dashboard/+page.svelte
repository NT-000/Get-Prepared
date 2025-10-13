<script lang="ts">

	import type { CourseProps } from '../../../types/course-tree';
	import CourseCard from '../../../components/CourseCard.svelte';

	let { data } = $props();

	const courses = $derived((data.courses ?? []) as CourseProps[]);
	console.log('Dashboard data:', data);


</script>

<section>
	<h1>This is the dashboard</h1>
	{#if courses.length}
		<div class="dashboard-container">

			<div class="courses">
				{#each courses as course (course.id)}
					<CourseCard {course} session={data.session} />
				{/each}
			</div>

		</div>
	{:else}
		<p>Du har ingen påmeldte kurs</p>
	{/if}
	<div class="user-stats-container">
		<div class="user-stats">
			
		</div>
	</div>
</section>

<style>
    ul {
        display: block;
        align-items: center;
        padding: 20px;
    }

    .dashboard-container {
        display: flex;
        flex-direction: column;
        margin-left: 20px;
        background-color: rgb(255, 255, 255);
        padding: 20px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        width: 50%;
    }

</style>

