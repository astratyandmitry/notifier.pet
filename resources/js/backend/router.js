import {createRouter, createWebHashHistory} from "vue-router";

const routes = [
  {
    path: '/',
    redirect: '/notifications',
    name: 'home'
  },
  {
    path: '/notifications',
    name: 'notifications.list',
    component: () => import('./views/NotificationsView.vue'),
  },
]

const router = createRouter({
  history: createWebHashHistory(),
  routes: routes,
})

export default router;
