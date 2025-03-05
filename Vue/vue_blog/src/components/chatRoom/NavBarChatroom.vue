<script setup>
import useLogout from "@/composables/useLogout.js";
import getCurrentUser from "@/composables/getCurrentUser.js";



</script>

<template>

</template>

<style scoped>
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
nav {
  color: darkgrey;
  text-decoration: none;
  margin-left: 20px;
}
header a.RouterLink-active {
  color: #2c3e50;
  font-weight: bold;
}
</style>
