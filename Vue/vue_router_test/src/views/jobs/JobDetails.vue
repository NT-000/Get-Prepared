<script>
export default {
  props: ['id'],
  data(){
    return {
      job: null,
    }
  },
  mounted() {
    console.log('Component mounted.' , this.id);
    fetch(`http://localhost:3000/jobs/${this.id}`)
      .then(res => res.json())
    .then(data => this.job = data)
      .catch(err => console.log(Error));
  },
}
</script>

<template>
  <div v-if="job">
<h1>{{ job.title }}</h1>
  <p> The job id is {{id}} job-id:{{job.id}}</p>
  <p>{{job.info}}</p>
  </div>
  <div v-else>
    <div>Loading data...</div>
  </div>

</template>

<style scoped>
.div{
  color:blue;
}
</style>
