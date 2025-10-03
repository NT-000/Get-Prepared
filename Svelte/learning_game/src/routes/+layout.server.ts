import type { LayoutServerLoad } from './$types';

export const load: LayoutServerLoad = async ({ locals, url }) => {
	let profile = null;
	if (locals.session?.user) {
		const { data } = await locals.supabase
			.from('profiles')
			.select('*')
			.eq('id', locals.session.user.id)
			.single();
		profile = data ?? null;
	}

	return {
		profile,
		session: locals.session,
		url: url.pathname
	};
};
