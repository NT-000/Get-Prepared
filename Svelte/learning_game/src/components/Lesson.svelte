<script lang="ts">
	import type { LessonProps } from '../types/course-tree';

	const { lesson } = $props<{ lesson: LessonProps }>();
</script>

<section>
	<li>{lesson.order_index}.{lesson.title}</li>
</section>

<style>

</style>