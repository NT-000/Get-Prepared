<script setup>
import getPosts from "@/composables/getPosts.js";
import {computed, onMounted, ref} from "vue";

const props = defineProps({
  search: String,
  isSearch: Boolean,
})

const {posts, error, load} = getPosts()
const filteredSearch = computed(() =>
  posts.value.filter((post) =>
    post.title.toLowerCase().includes(props.search.toLowerCase()) ||
    post.tags.some(tag => tag.toLowerCase().includes(props.search.toLowerCase()))
  )
);

onMounted(() =>{
  load();
})
</script>

<template>

  <div v-if="filteredSearch">
    <div v-if="isSearch" class="results">
      <div v-for="search in filteredSearch" :key="search.id">
        <div class="post" >{{search.title}} - <span v-for="tag in search.tags">#{{tag}}</span>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>
