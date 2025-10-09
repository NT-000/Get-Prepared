<script lang="ts">

	import Module from '../../../components/Module.svelte';
	import type { CourseProps } from '../../../types/course-tree';
	import Button from '../../../components/shared/Button.svelte';
	import AccordianDropdown from '../../../components/shared/AccordianDropdown.svelte';
	import CourseCard from '../../../components/CourseCard.svelte';

	let { data } = $props();

	let isOpenCourse = $state(false);

	const courses = $derived((data.courses ?? []) as CourseProps[]);
	console.log('Dashboard data:', data);


</script>

<section>
	<h1>This is the dashboard</h1>
	<div class="dashboard-container">
		<div class="courses">
			{#each courses as course (course.id)}
				<CourseCard {course} session={data.session} />
			{/each}
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
        background-color: rgba(135, 134, 134, 0.5);
        padding: 20px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

</style>

