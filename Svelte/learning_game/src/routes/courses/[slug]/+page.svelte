<script lang="ts">
	import { Button } from '$lib';

	let { data } = $props();
	let { course, session } = data;
</script>

<section>
	<h1>{course.title}</h1>
	<p>{course.description}</p>
	<form method="POST" action="?/enrollCourse">
		<input type="hidden" name="course_id" value={course.id}>
		<Button type="submit" isSecondary={!session}>
			Meld deg på kurset
		</Button>
		{#if !session}
			<p>Logg inn for å melde deg på kurset</p>
		{/if}
	</form>
</section>

<style>

</style>

