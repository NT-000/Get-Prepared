<script lang="ts">

	import Module from '../../../components/Module.svelte';
	import type { CourseProps } from '../../../types/course-tree';

	let { data } = $props();

	const courses = $derived((data.courses ?? []) as CourseProps[]);
	console.log('Dashboard data:', data);


</script>

<section>
	<h1>This is the dashboard</h1>
	<div class="dashboard-container">
		<div class="courses">
			<div class="course-card">
				{#each courses as course (course.id)}
					<div>{course.title}</div>
					<ul>
						{#each course.modules as mod (mod.id)}
							<Module {mod} />
						{/each}
					</ul>
				{/each}
			</div>
		</div>
	</div>
</section>

<style>
    ul {
        display: block;
        align-items: center;
        padding: 20px;
    }

    li {
        font-style: italic;
        list-style: none;
        display: flex;
        width: 300px;
        padding: 10px;
    }
</style>

