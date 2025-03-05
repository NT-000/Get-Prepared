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
      <h1 @click="isHobbiesOpen = !isHobbiesOpen">Hobbies <img src="/menu.svg"></h1>
      <div class="hobbies" v-if="isHobbiesOpen">
        <div v-for="hobby in currentUser.hobbies" :key="hobby.id">
          <div>{{hobby}}</div>
        </div>
      </div>
      <h1 @click="isSkillsOpen = !isSkillsOpen">Skills<img src="/menu.svg"></h1>
      <div class="skills"  v-if="isSkillsOpen">
        <div v-for="skill in currentUser.skills" :key="skill.id">
          <p>{{skill}}</p>
        </div>
      </div>

    </nav>
  </div>

</template>

<style scoped>
.skills {
  display: inline-block;
}
</style>
