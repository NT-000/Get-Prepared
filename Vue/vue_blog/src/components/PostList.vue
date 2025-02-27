<script setup>
import {defineProps, onMounted, onUnmounted, onUpdated, ref} from "vue";
import SinglePost from "@/components/SinglePost.vue";

const props = defineProps({
posts: Array
})

const showPosts = ref(true)

onMounted(() => {
  // fetch('/posts')
  //   .then((res) => res.json())
  // .then(data => posts = data)
  //   .catch(error => console.log(error));

})
onUnmounted(() => {
  console.log('unmounted');
})
onUpdated(() => {
  console.log('updated');
})



</script>

<template>

  <div class="post-list">

  <div v-for="post in posts" :key="post.id" class="post">
    <SinglePost v-if="showPosts" :post="post"/>
    </div>
    <button @click="showPosts = !showPosts">Show posts</button>
    <button @click="posts.pop()">Delete post</button>
  </div>
</template>

<style scoped>

.post-list {
  padding: 10px;
  border: 1px solid #ddd;
  }
.post{
  padding: 10px;
  margin-bottom: 30px;
}
.post:hover {
  background-color: deepskyblue;
  cursor: pointer;
}
</style>
