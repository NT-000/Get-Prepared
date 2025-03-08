<script setup>
import {ref} from "vue";
import {Timestamp} from "firebase/firestore";
import getCurrentUser from "@/composables/getCurrentUser.js";
import useCollection from "@/composables/useCollection.js";

const {currentUser} = getCurrentUser()
const message = ref('');
const {addDocument, error} = useCollection('messages');
const sendMessage = async () => {
  let messageToSend = {
    sender: currentUser.value.name,
    message: message.value,
    createdAt: Timestamp.now()
  }
  await addDocument(messageToSend);
  if(!error.value){
  console.log(messageToSend);
  message.value = '';
  }
}
</script>

<template>
  <form @submit.prevent="sendMessage">
    <div>
    <input type="text" placeholder="Enter your message here..." v-model="message">
    </div>
    <div>
      {{error}}
    </div>
  </form>
</template>

<style scoped>

</style>
