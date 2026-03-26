import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/o-projektu',
    name: 'about',
    component: () => import('../views/AboutView.vue')
  },
  {
    path: '/reference',
    name: 'reference',
    component: () => import('../views/ReferenceView.vue')
  },
  {
    path: '/exterier',
    name: 'exterier',
    component: () => import('../views/ExterierView.vue')
  },
  {
    path: '/interier',
    name: 'interier',
    component: () => import('../views/InterierView.vue')
  },
  {
    path: '/cenik',
    name: 'cenik',
    component: () => import('../views/CenikView.vue')
  },
  {
    path: '/predprodejni-priprava',
    name: 'predprodejni',
    component: () => import('../views/PredprodejniView.vue')
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes,
  scrollBehavior(to, from, savedPosition) {
    if (to.hash) {
      return {
        el: to.hash,
        behavior: 'smooth',
        top: 80
      }
    }
    if (savedPosition) {
      return savedPosition
    }
    return { top: 0, behavior: 'instant' }
  }
})

export default router
