import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'
import PostList from "@/components/PostList.vue";
import Details from "@/views/Details.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home,
    },
    {
      path: '/Details/:id',
      name: 'Details',
      component: Details,
      props: true,
    },
  ],
})

export default router
