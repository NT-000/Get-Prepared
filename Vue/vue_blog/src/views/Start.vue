<script setup>
import SignupForm from "@/components/login/SignupForm.vue";
import { ref} from "vue";
import LoginForm from "@/components/login/LoginForm.vue";
import {useRouter} from "vue-router";

const showLogin = ref(true);

const router = useRouter()
const goToChat = () =>{
  router.push("/about");
}

</script>

<template>
<div class="login">
  <div v-if="showLogin" :key="showLogin">
    <LoginForm @loginSuccess="goToChat"/>
  </div>
  <div v-else :key="!showLogin">
    <SignupForm @signupSuccess="goToChat"/>
  </div>
  <button @click="showLogin = !showLogin">
    <span v-if="showLogin">Don't have an account? Register here</span>
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
