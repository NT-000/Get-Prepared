<script lang="ts">

	import Module from './Module.svelte';
	import Button from './shared/Button.svelte';
	import type { CourseProps } from '../types/course-tree';
	import type { Session } from '@supabase/supabase-js';
	import { chevron } from '$lib';


	let { course, session = null, isEnrolled = false } = $props<{
		course: CourseProps;
		session?: Session;
		isEnrolled?: boolean;
	}>();

	console.log('CourseCard data:', course);

	let isOpenCourse = $state(false);
	let openModuleId = $state<string | null>(null);

	function toggleModule(moduleId: string) {
		openModuleId = openModuleId === moduleId ? null : moduleId;
	}

</script>

<section>
	<div class="course-container">
		<div class="inner-card">
			<div class="card-info">
				<div class="course-card {isEnrolled ? 'enrolled' : ''}">

					<Button onclick={() => isOpenCourse = !isOpenCourse}
									isDropdown={true} isExpanded={isOpenCourse}>
						<span class="button-content">
							{#if !isEnrolled}
								<Button isDisabled={isEnrolled} href={`/courses/${course.slug}`} isMenu={true}>
									<span class="title">
										{course.title}
								</span>
							</Button>

							{:else}
								{course.title}<span class="enrollment-badge">Påmeldt</span>
							{/if}
							{#if !isEnrolled}
							<img src={chevron} alt="drop-down-chevron" class="chevron" />
								{/if}
						</span>

					</Button>
					{#if isOpenCourse}
						{#if isEnrolled}
							<ul>
								{#each course.modules as mod (mod.id)}
									<div class="module">
										<Module
											{mod}
											{session}
											isOpen={openModuleId === mod.id}
											onToggle={() => toggleModule(mod.id)}
										/>
									</div>
								{/each}
							</ul>
						{:else}
							<div class="locked-content">
								<p>Du må melde deg på kurset for å se hele innholdet</p>
								<Button href={`/courses/${course.slug}`}>Meld deg på</Button>
							</div>
						{/if}
					{/if}


				</div>
			</div>
		</div>
	</div>
</section>

<style>

    .course-container {
        width: 100%;
    }

    .course-card {
        width: 100%;
        position: relative;
    }

    .course-card.enrolled {
        border-left: 4px solid #4CAF50;
        background-color: #f1f8f4;
    }

    .enrollment-badge {
        display: inline-block;
        margin-left: 10px;
        padding: 2px 8px;
        background-color: #4CAF50;
        color: white;
        font-size: 0.75rem;
        font-weight: 600;
        border-radius: 12px;
        text-transform: uppercase;
        vertical-align: middle;
    }

    .locked-content {
        padding: 20px;
        text-align: center;
        background-color: #f5f5f5;
        border: 2px dashed #ccc;
        border-radius: 8px;
        margin: 10px;
    }

    .locked-content p {
        margin-bottom: 15px;
        color: #666;
        font-size: 1rem;
    }

    .module:last-child {
        border-bottom: 2px solid #ededed;
    }
</style>