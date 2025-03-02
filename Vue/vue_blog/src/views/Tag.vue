<script setup>
import getPosts from "@/composables/getPosts.js";
import {computed, onMounted, ref} from "vue";
import {useRoute} from "vue-router";
import PostList from "@/components/PostList.vue";
import TagCloud from "@/components/TagCloud.vue";

const props = defineProps({
  id: String,
})
const {posts, error, load} = getPosts();
const route = useRoute();
const filteredPosts = computed(() => posts.value.filter((post) => post.tags.includes(route.params.id)));

onMounted(() => {
  load()
})
</script>

<template>
  <div class="tag">
  <h1>Showing posts with tag #{{id}} </h1>
  <div v-if="filteredPosts.length" class="layout">
  <PostList :posts="filteredPosts"></PostList>
  <TagCloud :posts="posts"/>
  </div>
  <div v-else>
    No matching tags found.
  </div>
  </div>
</template>

<style>
.tag{
  max-width: 1200px;
  margin: 0 auto;
  padding: 10px 0;
}
</style>
