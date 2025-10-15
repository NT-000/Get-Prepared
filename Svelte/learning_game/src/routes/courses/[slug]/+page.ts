import type { PageLoad } from './$types';
import { supabase } from '$lib/supabase/client';
import { error } from '@sveltejs/kit';

export const load: PageLoad = async ({ params, parent }) => {
	const { session } = await parent();
	const courseSlug = params.slug;

	const { data } = await supabase.from('courses').select('*').eq('slug', courseSlug).single();
	if (!data) {
		return error(404, 'Not found');
	}

	let isEnrolled = false;
	if (session?.user) {
		const { data: enrollment } = await supabase
			.from('enrollments')
			.select('course_id')
			.eq('user_id', session.user.id)
			.eq('course_id', data.id)
			.single();

		isEnrolled = !!enrollment;
	}

	return {
		course: data,
		session,
		isEnrolled
	};
};
