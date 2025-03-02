<script setup>
import getPost from "@/composables/getPost.js";
import {onMounted} from "vue";
import {useRoute} from "vue-router";

const route = useRoute();
console.log('route:',route);

const props = defineProps({
id: String

})
const {post, error, load} = getPost(route.params.id);

onMounted(() => {
  load()
})
</script>

<template>
<h1>Posts</h1>
<div v-if="error" class="error">{{error}}</div>
  <div v-if="post" class="post">
    <h1>{{post.title}}</h1>
    <p>{{post.body}}</p>
    <div v-for="tag in post.tags" class="tags">
      #{{tag}}
    </div>
  </div>

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
