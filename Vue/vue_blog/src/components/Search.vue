<script setup>
import getPosts from "@/composables/getPosts.js";
import {computed, onMounted, ref} from "vue";
import SinglePost from "@/components/SinglePost.vue";

const search = ref('')
const {posts, error, load} = getPosts()
const filteredSearch = computed(() =>
  posts.value.filter((post) =>
    post.title.toLowerCase().includes(search.value.toLowerCase()) ||
    post.tags.some(tag => tag.toLowerCase().includes(search.value.toLowerCase()))
  )
);

onMounted(() =>{
  load();
})
</script>

<template>
  <input type="text" placeholder="Search for a post..." v-model="search" />
  <div v-if="filteredSearch.length">

      <div v-for="post in filteredSearch" :key="post.id">
        <div class="post" >
          <SinglePost :post="post"></SinglePost>
        </div>
      </div>
  </div>
</template>

<style scoped>
input {
  height: 30px;

}
button {
  height: 30px;
  margin: 0 10px;
  width: 100px;
  border-radius: 5px;
}
button:hover {
  cursor: pointer;
  box-shadow: rgb(0, 0, 0, 0.3) 1px 1px 1px;
  background-color: deepskyblue;
}
input:focus {
  outline: none;
  border: 1px solid white;
  border-radius: 10px;
}

</style>
