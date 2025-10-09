import type { PageLoad } from './$types';
import { supabase } from '$lib/supabase/client';

export const load: PageLoad = async ({ parent }) => {
	const { session } = await parent();

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

	console.log('courses pageload:', courses);

	return { courses: courses ?? [], session: session };
};
