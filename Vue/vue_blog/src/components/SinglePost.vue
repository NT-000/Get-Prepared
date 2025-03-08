<script setup>
import {defineProps} from "vue";

const props = defineProps({
  post: Object,
})
const snippet = props.post.body.substring(0,25)
</script>

<template>
  <div class="blog-post">
  <router-link :to="{name: 'Details', params: {id: props.post.id}}">
    <h1>{{props.post.title}}</h1>
    <p>{{props.post.name}}</p>
  <div class="post">
    <h3>{{snippet}} ....</h3>
  </div>
    <div>{{props.post.createdAt}}</div>
  </router-link>
  <div v-for="tag in props.post.tags" :key="tag" class="tags">
    <router-link :to="{name: 'Tag', params: {id: tag}}"><span>#{{tag}}</span></router-link>

  </div>
  </div>
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
.post h3{
  display: inline-block;
  position: relative;
  font-size: 1.2rem;
  color: gray;
  margin-bottom: 10px;
  max-width: 400px;
}
}
.post h3::before{
  content: '';
  display: block;
  width: 100%;
  height: 100%;
  position: absolute;
  z-index: -1;
  padding-right: 40px;
  left: -30px;
  transform: rotateZ(-1deg);
}
.tags span:hover{
  border: 1px solid gray;
  padding: 10px;
  border-radius: 5px;
}
button:hover {
  cursor: pointer;
  box-shadow: rgb(0, 0, 0, 0.3) 1px 1px 1px;
  background-color: deepskyblue;
}
.blog-post{
  cursor: pointer;
  box-shadow: rgb(0, 0, 0, 0.3) 1px 1px 1px;
  border-radius: 5px;
}
.blog-post:hover{
  cursor: pointer;
  background-color: grey;
  transform: scale(1.10);

}
</style>
