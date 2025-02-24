<script>
import SignupForm from './components/SignupForm.vue'
export default {
  components: {SignupForm},
  data() {},
  props: {},
  computed: {},
}
</script>


<template>
  <header>

    <div class="wrapper">
      <h1>Login</h1>
    </div>
    <SignupForm>
    </SignupForm>
  </header>

</template>

<style scoped>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #444;
  margin-top: 60px;
}
body{
  margin:0;
  color: deepskyblue;
}
</style>
