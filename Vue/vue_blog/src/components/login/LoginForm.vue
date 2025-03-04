<script setup>

import {onMounted, ref} from "vue";
import getUsers from "@/composables/getUsers.js";

const email = ref('')
const password = ref('')
const {users, load} = getUsers()
onMounted(() => {
  load()
})
const loginUser = async () => {

}

</script>

<template>
  <h1>Login</h1>
  <form @submit.prevent="loginUser" class="login-form">
    <label>Email
    <input type="text" v-model="email"></label>
    <label>Password
      <input type="text" v-model="password"></label>
    <br>
    <button @click="loginUser">Login</button>
  </form>
</template>

<style scoped>
form {
  max-width: 420px;
  margin: 30px auto;
  background: white;
  text-align: left;
  padding: 40px;
  border-radius: 10px;
}
label {
  color: #aaa;
  display: inline-block;
  margin: 10px 10px 10px 15px;
  font-size: 0.6em;
  text-transform: uppercase;
  letter-spacing: 1px;
  font-weight: bold;
}
input, select {
  display: block;
  padding: 10px 6px;
  width: 100%;
  box-sizing: border-box;
  border: none;
  border-bottom: 1px solid #ddd;
  color: #555;
}
</style>
