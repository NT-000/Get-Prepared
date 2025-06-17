
<script>
	const {data} = $props()

	$inspect("data", data)
	console.log("data", data)
</script>

<main>
	<h1>{data.blogPost}</h1>
<!--	<div>-->
<!--		{#each blogs as post (post.id)}-->
<!--			<div>-->
<!--				{post.id}-->
<!--				{post.text}-->
<!--			</div>-->
<!--			{/each}-->
<!--	</div>-->
</main>

<style>

</style>