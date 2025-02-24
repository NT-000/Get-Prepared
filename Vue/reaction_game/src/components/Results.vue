<script>
import Block from "@/components/Block.vue";

export default {
  components: {Block},
  props: ['score', 'isPlaying'],
  data(){
    return {
      output: '',
    }
  },
  computed: {
    output() {
      if (this.score < 0.2) return "<img src=\"/bee.svg\" alt=\"bee\">You are fast as a bee!";
      if (this.score < 0.4) return "<img src=\"/rabbit.svg\" alt=\"rabbit\">You are fast as a rabbit. ";
      if (this.score < 0.6) return "<img src=\"/dog.svg\" alt=\"dog\">You have average pace, like a dog!";
      if (this.score < 0.8) return "<img src=\"/bug.svg\" alt=\"bug\"> You are slow as a beetle.";
      return "You are super slow!";
    },
  },
    methods: {},
  }
</script>

<template>

  <div class="container" v-if="!isPlaying">
    <p>Reaction time: {{ score }} seconds.</p>
    <p class="output" v-html="output"></p>
  </div>

</template>

<style scoped>
img{
  height: 150px;
  width: 150px;
}
.output {
  font-size: 50px;
  color: deepskyblue;
  font-weight: bold;
}

</style>
