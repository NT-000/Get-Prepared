<script setup>
import useTags from "@/composables/useTags";
import {onMounted} from "vue";

const props = defineProps({
  posts: Array,
})
const {tags} = useTags(props.posts);

onMounted(()=>{

})

</script>

<template>
  <div class="tag-cloud">
    <h3>Tags</h3>
    <div v-if="tags" class="tag-cloud-list">
      <div v-for="tag in tags" :key="tag" class="tag-cloud-list__item">
        <RouterLink :to="{name: 'Tag', params:{id:tag}}">#{{tag}}</RouterLink>
      </div>
    </div>
  </div>
</template>

<style scoped>
.tag-cloud{
  padding: 10px;
}
.tag-cloud h3{
  padding: 16px 8px;
  color: #2c3e50;
}
.tag-cloud div{
  display: inline-block;
  padding: 10px;
}
.tag-cloud a{
  text-decoration: none;
  color: springgreen;
}
.active-link {
  color: green;
  font-weight: bold;
}
</style>
