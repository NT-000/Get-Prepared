<script setup>

import {onMounted, ref} from "vue";
import {useRouter} from "vue-router";
import {projectFirestore} from "@/firebase/config.js";
import { collection, addDoc, Timestamp } from "firebase/firestore";
import getCurrentUser from "@/composables/getCurrentUser.js";

const {currentUser} = getCurrentUser();

const router = useRouter();
console.log(router);

const tag = ref('');
const tags = ref([]);

const newPost = ref({
  title: '',
  body: '',
  tags: tags.value,
  name: currentUser.value.name,
})

const tagKeyDownEvent = () => {
  console.log(tag.value)
  if (!newPost.value.tags.includes(tag.value)) {
    newPost.value.tags.push(tag.value)
  }
  tag.value = ''
}
const createPost = async () => {
  try{
    const res = await addDoc(collection(projectFirestore, 'posts'),{
      ...newPost.value,
      createdAt: Timestamp.now(),
    });

    newPost.value.title = "";
    newPost.value.body = "";
    tags.value = [];
    newPost.value.tags = [];
    router.push({name: 'Home'});

  if(!res.ok){
    console.log('failed creating post');
  }
    console.log('post created');
  }

  catch(error){
    error.value = error.message;
    console.error("Error:", error.value);
  }
}
onMounted(()=>{

})
</script>

<template>
  <h1>Create new blogpost</h1>
  <div class="create">
    <form @submit.prevent="createPost">
      <label>Title</label>
      <input type="text" v-model="newPost.title" required/>
      <label>Content</label>
      <textarea required v-model="newPost.body"></textarea>
      <label>Tags (enter to add a tag)</label>
      <input v-model.trim="tag" type="text" @keydown.enter.prevent="tagKeyDownEvent" />
      <button type="submit" @click="">Create Post</button>
    </form>
    <div v-for="tag in tags" :key="tag" class="tag">
      #{{tag}}
    </div>
    <div>{{newPost.title}} - {{newPost.body}} - {{newPost.tags}}</div>
  </div>
</template>

<style scoped>
form {
  max-width: 480px;
  margin: 0 auto;
  text-align: left;
}
input, textarea {
  display: block;
  margin: 10px 0;
  width: 100%;
  box-sizing: border-box;
  padding: 10px;
  border: 1px solid #eee;
}
textarea {
  height: 160px;
}
label {
  display: inline-block;
  margin-top: 30px;
  position: relative;
  font-size: 20px;
  color: white;
  margin-bottom: 10px;
}
label::before {
  content: "";
  display: block;
  width: 100%;
  height: 100%;

  position: absolute;
  z-index: -1;
  padding-right: 40px;

}
button {
  display: block;
  margin-top: 30px;
  background: deepskyblue;
  color: white;
  border: none;
  padding: 8px 16px;
  font-size: 18px
}
.tag {
  display: inline-block;
  margin: 10px 10px 0 0;
  color: #444;
  background: #ddd;
  padding: 8px;
  border-radius: 20px;
  font-size: 14px;
}
</style>
