import { createBrowserClient } from '@supabase/ssr';
import type { Database } from '$lib/supabase/database.types';
import { PUBLIC_SUPABASE_URL, PUBLIC_SUPABASE_ANON_KEY } from '$env/static/public';

export const supabase = createBrowserClient<Database>(
	PUBLIC_SUPABASE_URL,
	PUBLIC_SUPABASE_ANON_KEY,
	{
		auth: {
			flowType: 'pkce',
			persistSession: true,
			autoRefreshToken: true,
			detectSessionInUrl: true
		}
	}
);
