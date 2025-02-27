<script setup>
import {defineProps} from "vue";

const props = defineProps({
  post: Object,
})
const snippet = props.post.body.substring(0,25)
</script>

<template>
  <router-link :to="{name: 'Details', params: {id: props.post.id}}">
    <h1 :post="post">{{post.title}}</h1>
  <div class="post">
    <h3>{{snippet}} ....</h3>
    <div v-for="tag in post.tags" :key="tag" class="tags">
      <span>#{{tag}}</span>
    </div>
  </div>
  </router-link>
</template>

<style scoped>
h1{
  font-size: 1.3rem;
  font-weight: bold;
  text-transform: uppercase;
  padding-top: 5px;
}
.tags{
  font-size: large;
  display: inline-block;
  margin: 10px;
  padding: 10px;

}
</style>
