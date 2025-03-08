import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import {projectAuth} from "@/firebase/config.js";
import {onAuthStateChanged} from "firebase/auth";


let app

onAuthStateChanged(projectAuth, ()=>{
  if(!app){
  app = createApp(App)
  .use(router)
  .mount('#app')
  }
})

