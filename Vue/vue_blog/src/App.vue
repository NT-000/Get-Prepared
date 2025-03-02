<script setup>
import NavBar from "@/components/NavBar.vue";
import { RouterLink, RouterView } from 'vue-router'

</script>

<template>
  <header>
    <img alt="Vue logo" class="logo" src="/bitcoin.svg" width="125" height="125" />
    <NavBar></NavBar>
  </header>

  <RouterView />
</template>

<style scoped>
header {
  line-height: 1.5;
  max-height: 100vh;
}

.logo {
  display: block;
  margin: 0 auto 2rem;
}

</style>
