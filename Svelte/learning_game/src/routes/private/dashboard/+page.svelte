<script lang="ts">

	import Module from '../../../components/Module.svelte';
	import type { CourseProps } from '../../../types/course-tree';
	import Button from '../../../components/shared/Button.svelte';
	import AccordianDropdown from '../../../components/shared/AccordianDropdown.svelte';

	let { data } = $props();

	let isOpenCourse = $state(false);

	const courses = $derived((data.courses ?? []) as CourseProps[]);
	console.log('Dashboard data:', data);


</script>

<section>
	<h1>This is the dashboard</h1>
	<div class="dashboard-container">
		<div class="courses">
			<div class="course-card">
				{#each courses as course (course.id)}
					<Button onclick={() => (isOpenCourse = !isOpenCourse)} isDropdown={true}>{course.title}
						<AccordianDropdown isOpen={isOpenCourse} />
					</Button>
					{#if isOpenCourse}
						<ul>
							{#each course.modules as mod (mod.id)}
								<Module {mod} />
							{/each}
						</ul>
					{/if}
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

</style>

