<script setup>
import {computed, defineProps, onMounted, onUnmounted, onUpdated, ref} from "vue";
import SinglePost from "@/components/SinglePost.vue";

const props = defineProps({
posts: Array,
  filteredPosts: Array
})

const showPosts = ref(true)
const deletePost = computed(()=>{

})
onMounted(() => {

})
onUnmounted(() => {
  console.log('unmounted');
})
onUpdated(() => {
  console.log('updated');
})



</script>

<template>

    <button @click="showPosts = !showPosts">Show posts</button>
    <button @click="posts.pop()">Delete post</button>
  <div class="post-list">
  <div v-if="filteredPosts && filteredPosts.length" class="filteredPosts">
    <div v-for="post in filteredPosts" :key="post.id">
      <SinglePost v-if="showPosts" :post="post"/>
      </div>
  </div>
    <div v-if="!filteredPosts || filteredPosts.length === 0">
  <div v-for="post in posts" :key="post.id" class="post">
    <SinglePost v-if="showPosts" :post="post"/>
    </div>
    </div>
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
button{
  padding: 10px;
  margin-top: 10px;
  justify-content: space-between;
  border-radius: 5px;
}
button:hover {
  cursor: pointer;
  box-shadow: rgb(0, 0, 0, 0.3) 1px 1px 1px;
  background-color: deepskyblue;
}

</style>
