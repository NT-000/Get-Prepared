<script>


export default {
data(){
  return {
    jobs:[],
  }
},
  mounted() {
  fetch('http://localhost:3000/jobs')
    .then(res => res.json())
    .then(data => this.jobs = data)
      .catch(err => console.log(err))
  },
  methods: {

  },
}
</script>

<template>
<h1>Jobs</h1>
  <div v-if="jobs.length">
  <div v-for="job in jobs" :key="job.id" class="jobs">
    <div class="jobs">
      <router-link :to="{name:'JobDetails', params: {id:job.id}}" ><h2>{{job.title}}</h2></router-link>
    </div>
  </div>
  </div>
  <div v-else>
    <p>The array is empty</p>
  </div>

</template>

<style scoped>
.jobs h2{
  background: #fff;
  padding: 20px;
  border-radius: 10px;
  margin: 10px auto;
  max-width: 800px;
  cursor: pointer;
  color: deepskyblue;
}
.jobs h2:hover{
  text-decoration: underline;
  background: lightskyblue;
}
.jobs a{
  text-decoration: none;
}
</style>
