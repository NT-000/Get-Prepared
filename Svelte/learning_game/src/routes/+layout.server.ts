import type { LayoutServerLoad } from './$types';

export const load: LayoutServerLoad = async ({ locals, url }) => {
	const errors: string[] = [];

	const {
		data: { user },
		error: userError
	} = await locals.supabase.auth.getUser();
	if (userError) {
		errors.push(userError.message);
	}

	if (user) {
		const display = user.user_metadata?.full_name ?? user.email ?? user.user_metadata?.name;
		const avatar = user.user_metadata?.picture;

		console.log('display_name:', display);
		console.log('avatar:', avatar);

		const { error: upsertErr } = await locals.supabase
			.from('profiles')
			.upsert({ id: user.id, display_name: display, avatar_url: avatar }, { onConflict: 'id' });

		if (upsertErr) errors.push(upsertErr.message);
	}

	let profile = null;
	if (user) {
		const { data, error: profErr } = await locals.supabase
			.from('profiles')
			.select('*')
			.eq('id', user.id)
			.single();

		if (profErr) errors.push(profErr.message);
		profile = data ?? null;
	}

	return {
		profile,
		errors,
		session: locals.session,
		url: url.pathname
	};
};
