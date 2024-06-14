/**
 * router/index.ts
 *
 * Automatic routes for `./src/pages/*.vue`
 */

// Composables
import { createRouter, createWebHistory } from 'vue-router/auto'

import Login from '../components/HomeLogin.vue'
import Register from '../components/HomeRegister.vue'
import Tasks from '../components/TasksAuthenticate.vue'

const routes = [
  { path: '/', component: Login },
  { path: '/register', component: Register },
  { path: '/tasks', component: Tasks }
]

const router = createRouter({
  // history: createWebHistory(import.meta.env.BASE_URL),
  history: createWebHistory(),
  routes
})

export default router
