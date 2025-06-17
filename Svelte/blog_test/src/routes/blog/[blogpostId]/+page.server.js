import { error } from '@sveltejs/kit';

export const load = async ({params}) => {

	const blogs = [
		{id: 0,
		text: "Number 1 blog post",},
		{id: 1,
		text: "Number 2 blog post",},
		{id: 2,
		text: "Number 3 blog post",},
		{id: 3,
		text: "Number 4 blog post",},
	]

	console.log(blogs)
	console.log(params)

	const foundBlogPost = await blogs.find(blog => blog.id.toString() === params.blogpostId)
	if (foundBlogPost) {
		return {
			blogPost: foundBlogPost.text,
			blogPosts: blogs
		}
	}
	throw error(404, "No blog post found")
}