import {createClient} from "@supabase/supabase-js"
import type { Database } from '$lib/supabase/database.types';
import {PUBLIC_SUPABASE_URL, PUBLIC_SUPABASE_ANON_KEY} from '$env/static/public';

export const supabase = createClient<Database>(PUBLIC_SUPABASE_URL, PUBLIC_SUPABASE_ANON_KEY, {
	auth: { persistSession: true, autoRefreshToken: true, detectSessionInUrl: true},
})