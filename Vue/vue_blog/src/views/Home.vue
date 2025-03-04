<script setup>

import {computed, onMounted, ref} from "vue";
import getPosts from "@/composables/getPosts.js";
import Search from "@/components/Search.vue";
import TagCloud from "@/components/TagCloud.vue";

const search = ref('')
const isShowing = ref(true);
const {posts, error, load} = getPosts()

const shouldShowPosts = computed(() => isShowing.value && !search.value);


onMounted(() => {
 load()
})

</script>

<template>
  <div class="home">
    <div v-if="error">
      {{error}}
    </div>
<Search v_model="search" />
    <div v-if="posts.length" class="layout">
      <div class="tags">
        <TagCloud :posts="posts"></TagCloud>
      </div>
    </div>
    <div v-else>
      No posts found.
    </div>
  </div>
</template>

<style>
.home{
  max-width: 1200px;
  margin: 0 auto;
  padding: 10px 0;
}


.layout{
  display: grid;
  grid-template-columns: 3fr 1fr;
  gap: 20px;
}
.post p{
  font-size: medium;
  font-family: "Comic Sans MS", cursive;
}
</style>


