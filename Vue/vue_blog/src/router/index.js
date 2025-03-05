import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'
import Create from '../views/Create.vue'
import Details from "@/views/Details.vue";
import NotFoundView from "@/views/NotFoundView.vue";
import Tag from "@/views/Tag.vue";
import About from "@/views/About.vue";
import RealTime from "@/views/RealTime.vue";
import Chatroom from "@/views/Chatroom.vue";
import Start from "@/views/Start.vue";
import {projectAuth} from "@/firebase/config.js";

const authGuard = (to,from,next) =>{
  let user = projectAuth.currentUser;
  console.log('current user auth guard',user);
  if(!user){
    next({path:'/start'});
  }else{
    next()
  }

}
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
      component: About,
      beforeEnter: authGuard,
    },
    {
      path:'/realtime',
      name: 'RealTime',
      component: RealTime
    },

    {
      path:'/start',
      name: 'Start',
      component: Start
    },
    {
      path:'/chatroom',
      name: 'Chatroom',
      component: Chatroom,
      beforeEnter: authGuard
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
