import type { PageLoad } from './$types';
import { supabase } from '$lib/supabase/client';
import { error } from '@sveltejs/kit';

export const load: PageLoad = async ({ params, parent }) => {
	const { session } = await parent();
	const courseSlug = params.slug;

	const { data } = await supabase.from('courses').select('*').eq('slug', courseSlug).single();
	if (data) {
		return {
			course: data,
			session
		};
	}
	return error(404, 'Not found');
};
