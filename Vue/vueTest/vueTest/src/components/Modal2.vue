<template>

</template>
<script>
export default {
  name: "Modal2"
}
</script>


<style scoped>
.modal {
  width: 400px;
  padding: 20px;
  margin: 200px auto;
  background: white;
  border-radius: 10px;
}
.backdrop {
  top: 0;
  position: fixed;
  background: rgba(0,0,0,0.5);
  width: 100%;
  height: 100%;
}
.modal h1 {
  color: #03cfb4;
  border: none;
  padding: 0;
}
.modal p {
  font-style: normal;
}
.modal .actions {
  text-align: center;
  margin: 30px 0 10px 0;
  color: #333;
}
.modal .actions a {
  color: #333;
  padding: 8px;
  border: 1px solid #eee;
  border-radius: 4px;
  text-decoration: none;
  margin: 20px;
}

.modal.sale {
  background: crimson;
  color: white;
}
.modal.sale h1 {
  color: white;
}
.modal.sale .actions {
  color: white;
}
.modal.sale .actions a {
  color: white;
}
</style>


