<script setup>
import GetPosts from "@/composables/getPosts.js";
import {onMounted} from "vue";
import SinglePost from "@/components/SinglePost.vue";
import {collection, onSnapshot, orderBy} from "firebase/firestore";
import {projectFirestore} from "@/firebase/config.js";
const {posts, error, load} = GetPosts();


onMounted(()=>{
  load();
})
</script>

<template>
  <h1>About me</h1>
  <h3>Info</h3>
  <div v-for="post in posts">
    <SinglePost :post="post"/>
  </div>
</template>

<style scoped>

</style>
