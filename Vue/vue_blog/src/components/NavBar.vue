<script setup>

import {RouterLink} from "vue-router";
import getCurrentUser from "@/composables/getCurrentUser.js";
import useLogout from "@/composables/useLogout.js";

const {currentUser} = getCurrentUser();

const {logout, error} = useLogout();
const logoutEvent = async () => {
  await logout();
  if(!error.value){
    console.log("logged out");
  }
}


</script>

<template>
  <div class="wrapper">
    <h1>The Blog</h1>
    <nav>
      <RouterLink to="/start">Login</RouterLink>
      <div v-if="currentUser">
      <RouterLink to="/">Home</RouterLink>
      <RouterLink to="/realtime">test</RouterLink>
      <RouterLink to="/create">New post</RouterLink>
      <RouterLink to="/about">About</RouterLink>
      <RouterLink to="/chatroom">Chatroom</RouterLink>
        <button @click="logoutEvent">Logout</button>

      </div>
    </nav>
  </div>
</template>

<style>
header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin: 0 auto;
  padding: 10px;
}
header h1{
  color: white;
  font-size: 50px;
}
header a{
  color: darkgrey;
  text-decoration: none;
  margin-left: 20px;
}
header a.RouterLink-active {
  color: #2c3e50;
  font-weight: bold;
}
</style>
