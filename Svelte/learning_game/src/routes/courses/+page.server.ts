import type { Actions } from './$types';
import { redirect } from '@sveltejs/kit';

export const actions: Actions = {
	enrollCourse: async ({ request, locals: { supabase, session } }) => {
		const errors: string[] = [];

		if (!session?.user) {
			errors.push('Du må logge inn først.');
			return { status: 401, errors };
		}

		const formData = await request.formData();
		const courseId = formData.get('course_id') as string;

		const { error } = await supabase
			.from('enrollments')
			.upsert([{ user_id: session.user.id, course_id: courseId }]);

		if (error) {
			console.error('bug with enrollments', error);
			errors.push('Feil ved oppmelding på kurs.');
			return { status: 500, errors };
		}

		throw redirect(303, '/private/dashboard');
	}
};
