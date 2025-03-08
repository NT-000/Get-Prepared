<script setup>
import getCollection from "@/composables/getCollection.js";
const {documents, error} = getCollection('messages');
import {computed, defineProps} from "vue";



const props = defineProps({
  currentUser: Object,
})
const hasMessages = computed(() => documents.value && documents.value.length > 0);
</script>

<template>
  <h1>Chat</h1>
<div class="chat-window">
  <div class="chat-window-header">
    <div v-if="hasMessages" class="chat-window-title">

      <div v-if="documents && documents && documents.length">
        <div v-for="message in documents" :key="message.id" class="chat-message">
          <strong>{{ message.sender }}:</strong> {{ message.message }}
          <br>
          <span class="created-at">{{message.createdAt}}</span>
          <br>
        </div>

    </div>
  </div>
  <div v-if="error">
    {{ error }}
  </div>
</div>
</div>
</template>

<style scoped>
.chat-message {
  border: 1px solid #ccc;
  border-radius: 4px;
}
.chat-message:hover {
  transform: scale(1.10);
  background-color: #fff;
}

.chat-window-header {
  font-weight: bold;
}
</style>
