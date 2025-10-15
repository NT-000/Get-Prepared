<script lang="ts">

	import type { CourseProps } from '../../../types/course-tree';
	import CourseCard from '../../../components/CourseCard.svelte';
	import { Button } from '$lib';

	let { data } = $props();

	const courses = $derived((data.courses ?? []) as CourseProps[]);
	console.log('Dashboard rendering with data:', data);
	$inspect('Dashboard courses:', courses);

	const enrolledCourseIds = $derived(data.courseIds ?? []);


</script>

<section class="dashboard">
	<div class="dashboard-header">
		<h1>Mine Kurs</h1>
		<p class="subtitle">Dine påmeldte kurs og fremgang</p>
	</div>

	{#if courses.length}
		<div class="dashboard-container">
			<div class="courses-header">
				<h2>Aktive Kurs ({courses.length})</h2>
			</div>
			<div class="courses">
				{#each courses as course (course.id)}
					<CourseCard {course} session={data.session} isEnrolled={enrolledCourseIds.includes(course.id)} />
				{/each}
			</div>
		</div>
	{:else}
		<div class="empty-state">
			<div class="empty-icon"></div>
			<h2>Ingen påmeldte kurs enda</h2>
			<p>Start ved å melde deg på et kurs!</p>
			<Button href="/courses">Utforsk kurs</Button>
		</div>
	{/if}

	<div class="user-stats-container">
		<div class="user-stats">
		</div>
	</div>
</section>

<style>
    .dashboard {
        max-width: 1400px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    .dashboard-header {
        margin-bottom: 40px;
        text-align: center;
    }

    .dashboard-header h1 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 10px;
    }

    .dashboard-header .subtitle {
        font-size: 1.1rem;
        color: #666;
        font-weight: 400;
    }

    .dashboard-container {
        display: flex;
        flex-direction: column;
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        padding: 30px;
        border-radius: 16px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06),
        0 8px 24px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .dashboard-container:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08),
        0 12px 32px rgba(0, 0, 0, 0.1);
    }

    .courses-header {
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #e0e0e0;
    }

    .courses-header h2 {
        font-size: 1.5rem;
        font-weight: 600;
        color: #2c3e50;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .courses {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .empty-state {
        text-align: center;
        padding: 80px 40px;
        background-color: #f8f9fa;
        border-radius: 16px;
        border: 2px dashed #d0d0d0;
    }

    .empty-icon {
        font-size: 4rem;
        margin-bottom: 20px;
    }

    .empty-state h2 {
        font-size: 1.8rem;
        color: #333;
        margin-bottom: 10px;
    }

    .empty-state p {
        font-size: 1.1rem;
        color: #666;
        margin-bottom: 30px;
    }

    .user-stats-container {
        margin-top: 40px;
    }

    ul {
        display: block;
        align-items: center;
        padding: 20px;
    }
</style>

