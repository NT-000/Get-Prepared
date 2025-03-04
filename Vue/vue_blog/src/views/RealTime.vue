<script setup>
import {ref} from "vue";
import {collection, onSnapshot, orderBy, query} from "firebase/firestore";
import {projectFirestore} from "@/firebase/config.js";
import SinglePost from "@/components/SinglePost.vue";

const posts = ref([])



onSnapshot(collection(projectFirestore, 'posts'),
  orderBy('createdAt', 'desc'),
  (snapshot) => {
    posts.value = snapshot.docs.map((doc) => ({
      ...doc.data(), id: doc.id,
    }));
  })
</script>

<template>
  <h1>RealTime data</h1>
  <div v-for="post in posts" :key="post.id">
    <SinglePost :post="post" />
  </div>
</template>

<style scoped>

</style>
