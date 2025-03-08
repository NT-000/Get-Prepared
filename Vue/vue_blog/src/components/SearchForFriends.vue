<script setup>
import getCollection from "@/composables/getCollection.js";
import {ref, computed} from 'vue'
const {documents, error} = getCollection('users');

const search = ref(null)
const filteredSearchForFriends = computed(() =>{
if(!documents.value){
  return []
}

  documents.value.filter((friend) =>
    friend.name.toLowerCase().includes(search.value.toLowerCase())
  )
})

</script>

<template>
<div>
  <div>
    <input type="text" placeholder="Search for Friends" v-model="search" />
  </div>
  <div v-for="friend in filteredSearchForFriends" :key="friend.id">
    {{friend.name}}
  </div>
</div>
</template>

<style scoped>

</style>
