<script setup>

import {RouterLink} from "vue-router";
</script>

<template>
  <div class="wrapper">
    <h1>The Blog</h1>
    <nav>
      <RouterLink to="/">Home</RouterLink>
      <RouterLink to="/realtime">Real Time</RouterLink>
      <RouterLink to="/create">New post</RouterLink>
      <RouterLink to="/about">About</RouterLink>
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
