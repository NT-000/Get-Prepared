<script setup>
import getUsers from "@/composables/getUsers.js";
import SignupForm from "@/components/login/SignupForm.vue";
import {onMounted, ref} from "vue";
import LoginForm from "@/components/login/LoginForm.vue";

const showLogin = ref(true);
const {users, load} = getUsers();
onMounted( () => {
  load()
})


</script>

<template>
<div class="login">
  <div v-if="showLogin" :key="showLogin">
    <LoginForm />
  </div>
  <div v-else :key="!showLogin">
    <SignupForm />
  </div>
  <button @click="showLogin = !showLogin">
    <span v-if="showLogin">Register new user</span>
    <span v-else>Back to Login</span>
  </button>
</div>

</template>

<style>
.login{
  text-align: center;
  padding: 20px 0;
}
</style>
