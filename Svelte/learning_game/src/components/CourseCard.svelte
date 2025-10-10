<script lang="ts">

	import Module from './Module.svelte';
	import Button from './shared/Button.svelte';
	import type { CourseProps } from '../types/course-tree';
	import type { Session } from '@supabase/supabase-js';
	import { chevron } from '$lib';


	let { course, session = null } = $props<{ course: CourseProps; session?: Session }>();

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
				<div class="course-card">

					<Button onclick={() => isOpenCourse = !isOpenCourse}
									isDropdown={true} isExpanded={isOpenCourse}>
						<span class="button-content">
							<span class="title">{course.title}</span>
							<img src={chevron} alt="drop-down-chevron" class="chevron" />
						</span>

					</Button>
					{#if isOpenCourse}
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
    }

    .module:last-child {
        border-bottom: 2px solid #ededed;
    }
</style>