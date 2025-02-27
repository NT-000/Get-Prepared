import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import AboutView from '../views/AboutView.vue'
import JobsView from '../views/jobs/JobsView.vue'
import JobDetails from "@/views/jobs/JobDetails.vue";
import NotFoundView from '../views/NotFoundView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'HomeView',
      component: HomeView,
    },
    {
      path: '/about',
      name: 'AboutView',
      component: AboutView,
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      // component: () => import('../views/AboutView.vue'),
    },
    {
      path: '/jobs',
      name: 'JobsView',
      component: JobsView,
    },
    {
      path: '/jobs/:id',
      name: 'JobDetails',
      component: JobDetails,
      props: true,
    },
    //redirect
    {
      path: '/all-jobs',
      redirect: '/jobs',
    },
    //catch 404
    {
      path: '/:catchAll(.*)',
      name: 'NotFoundView',
      component: NotFoundView,
    },

  ],
})

export default router
