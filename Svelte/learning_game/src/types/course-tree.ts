import type { Database } from '$lib/supabase/database.types';

type ModuleRow = Database['public']['Tables']['modules']['Row'];
type CourseRow = Database['public']['Tables']['courses']['Row'];
type LessonRow = Database['public']['Tables']['lessons']['Row'];

export type CourseProps = Pick<CourseRow, 'id' | 'title' | 'description'> & {
	modules: ModuleProps[];
};

export type ModuleProps = Pick<ModuleRow, 'id' | 'title' | 'description' | 'order_index'> & {
	lessons: LessonProps[];
};

export type LessonProps = Pick<LessonRow, 'id' | 'title' | 'content_json' | 'order_index'>;
