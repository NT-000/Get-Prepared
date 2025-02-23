

<template>
  <h1>{{title}}</h1>
  <p>Willkommen!</p>
  <teleport to=".modals" v-if = "showModal">
  <Modal theme="" @close="toggleModal">
    <template v-slot:links>
      <a href="#">sign up</a>
      <br>
      <a href="#">more info</a>
    </template>
<h1>Limited offer</h1>
    <p>25% off!</p>
  </Modal>
  </teleport>

      <teleport to=".modals" v-if="showModal2"><
    <Modal theme="" @close="toggleModal2">
      <template v-slot:links>
        <a href="#">This is the second challenge</a>
      </template>
    </Modal>
      </teleport>
  <button @click.ctrl="toggleModal2">Toggle2(ctrl)</button>
  <button @click.alt="toggleModal">Open modal(alt)</button>

</template>

<script>
import Modal from './components/Modal.vue'
export default {
  name: 'App',
  components: {Modal},
  data(){
    return {
      title: 'My first Vue app',
      showModal: false,
      showModal2: false,
    }
  },
  methods: {
    toggleModal(){
      this.showModal = !this.showModal;
    },
    toggleModal2(){
      this.showModal2 = !this.showModal2;
    },
  }
}
</script>

<style>

#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
h1 {
  border-bottom: 1px solid #ddd;
  display: inline-block;
  padding-bottom: 10px;
}
</style>
