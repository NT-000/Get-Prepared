import { redirect } from '@sveltejs/kit';
import type { LayoutServerLoad } from './$types';
import { supabase } from '$lib/supabase/client';

export const load: LayoutServerLoad = async ({ parent }) => {
	const { session } = await parent();

	if (!session) {
		throw redirect(303, '/auth/login');
	}

	const { data: courses, error } = await supabase
		.from('courses')
		.select(
			`id, title, description, modules:modules (id, title, description, order_index, lessons: lessons (id,title, order_index, content_json))`
		)
		.order('title')
		.order('order_index', { referencedTable: 'modules' })
		.order('order_index', { referencedTable: 'modules.lessons' });

	if (error) {
		console.log(`fetch courses failed ${error?.message}`);
		return { courses: [], session };
	}

	console.log('courses', courses);

	return { courses: courses ?? [], session };
};
