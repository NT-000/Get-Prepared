import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'
import Create from '../views/Create.vue'
import Details from "@/views/Details.vue";
import NotFoundView from "@/views/NotFoundView.vue";
import Tag from "@/views/Tag.vue";
import About from "@/views/About.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'Home',
      component: Home,
    },
    {
      path: '/details/:id',
      name: 'Details',
      component: Details,
      props: true,
    },
    {
      path: '/create',
      name: 'Create',
      component: Create,
    },
    {
      path: '/tags/:id',
      name: 'Tag',
      component: Tag,
      props: true,
    },
    {
      path:'/about',
      name: 'About',
      component: About
    },
    {
      path: '/:catchAll(.*)',
      name: 'NotFoundView',
      component: NotFoundView,
    },
  ],
  linkActiveClass: "active-link",
})

export default router
