<script lang="ts">
	import { Button } from '$lib';

	let { data } = $props();
	let { course, session, isEnrolled } = data;
</script>

<section>
	<h1>{course.title}</h1>
	<p>{course.description}</p>
	{#if isEnrolled}
		<div class="enrolled-message">
			<p>Du er allerede påmeldt dette kurset</p>
			<Button href="/private/dashboard">Gå til dashboard</Button>
		</div>
	{:else}
		<form method="POST" action="?/enrollCourse">
			<input type="hidden" name="course_id" value={course.id}>
			<Button type="submit" isSecondary={!session}>
				Meld deg på kurset
			</Button>
			{#if !session}
				<p>Logg inn for å melde deg på kurset</p>
			{/if}
		</form>
	{/if}
</section>

<style>
    .enrolled-message {
        padding: 20px;
        background-color: #f1f8f4;
        border: 2px solid #4CAF50;
        border-radius: 8px;
        text-align: center;
        margin-top: 20px;
    }

    .enrolled-message p {
        color: #2e7d32;
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 15px;
    }
</style>

