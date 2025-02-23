<script>
import Block from "@/components/Block.vue";

export default {
  components: {Block},
  props: ['reactionTime'],
  methods: {
    showResult(){}
  },
}
</script>

<template>

  <div class="container">
  <div>
    <slot block=""></slot>
  </div>
  </div>

</template>

<style>

</style>
