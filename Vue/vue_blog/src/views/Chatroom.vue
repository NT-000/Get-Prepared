<script setup>

import getCurrentUser from "@/composables/getCurrentUser.js";
import {ref} from "vue";

const {currentUser} = getCurrentUser();
const isHobbiesOpen = ref(false)
const isSkillsOpen = ref(false)
</script>

<template>
  <div class="container">
    <nav v-if="currentUser">
      <p>Display {{currentUser.name}}</p>
      <p>Display logged in user email: {{currentUser.email}}</p>
    </nav>
  </div>

</template>

<style scoped>
.skills {
  display: inline-block;
}
</style>
