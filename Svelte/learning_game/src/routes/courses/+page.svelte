<script lang="ts">
	import CourseCard from '../../components/CourseCard.svelte';

	let { data } = $props();

	const courses = $derived(data.courses ?? []);
	const enrolledCourseIds = $derived(data.enrolledCourseIds ?? []);


	console.log('Courses page data:', data);

</script>

<main>

	<h1>Kurs du kan ta</h1>
	<div class="course-container">
		<div class="courses">
			<ul>
				{#each courses as course (course.id)}

					<CourseCard {course} session={data.session} isEnrolled={enrolledCourseIds.includes(course.id)} />

				{/each}
			</ul>
		</div>
		<div class="course-info">

		</div>
	</div>
</main>

