

<template>
  <header>
    <div class="wrapper">
      <h1>Reaction game</h1>
      <button @click="start" :disabled="isPlaying">Start</button>
    </div>
  </header>
<Block v-if="isPlaying" :delay="delay">

</Block>

  <main>

  </main>
</template>

<script>
import Block from "@/components/Block.vue";
export default {
  name:'App',
  components:{Block},
  data(){
    return{
      isPlaying:false,
      delay: null,

    }
  },
  methods:{
    start(){
      this.delay = 1000 + Math.random() * 3000;
    this.isPlaying = true
      console.log(this.delay)
    },
  },
}

</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #444;
  margin-top: 60px;
}
button {
  background: #0faf87;
  color: white;
  border: none;
  padding: 8px 16px;
  border-radius: 4px;
  font-size: 16px;
  letter-spacing: 1px;
  cursor: pointer;
  margin: 10px;
}

button[disabled] {
  opacity: 0.2;
  cursor: not-allowed;
}
</style>
