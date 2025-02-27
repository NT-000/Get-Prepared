<script setup>

import {computed, onMounted, ref, watch, watchEffect} from "vue";
import PostList from "@/components/PostList.vue"
import getPosts from "@/composables/getPosts.js";
import Search from "@/components/Search.vue";

const isSearch = ref(false);
const isShowing = ref(true);
const {posts, error, load} = getPosts()
const search = ref('')
onMounted(() => {
 load()
})

</script>

<template>
  <main>
    <h1>Homepage</h1>
    <input type="text" placeholder="Search for a post..." v-model="search" />
    <button @click="isSearch = !isSearch">Search</button>
    <div v-if="error">
      {{error}}
    </div>
<Search :search="search" :isSearch="isSearch" />
    <div v-if="posts.length">
      <div v-if="isShowing" class="results">
  <PostList :posts="posts" />
      </div>
    </div>
    <div v-else>
      No posts found.
    </div>
  </main>
</template>

<style scoped>
.post{
  width: 100%;
  height: 100%;
  display: inline-block;
  flex-direction: row;
  justify-content: center;
  background: darkgray;
  border: 1px solid darkgray;
  border-radius: 15px;
  margin: 10px;
  padding: 10px;
}
.tags{
  font-size: large;
  display: inline-block;
  margin: 10px;
  padding: 10px;

}
.post p{
  font-size: medium;
  font-family: "Comic Sans MS", cursive;
}
</style>


