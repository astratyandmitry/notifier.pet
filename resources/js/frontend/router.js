import {createRouter, createWebHashHistory} from "vue-router";
import {useAuthStore} from "./store";
import axios from "axios";

const routes = [
  {
    path: '/',
    name: 'home',
    component: () => import('./views/HomeView.vue'),
  },
  {
    path: '/login',
    name: 'login',
    component: () => import('./views/LoginView.vue'),
    meta: {
      requiresAuth: false,
    },
  }
]

const router = createRouter({
  history: createWebHashHistory(),
  routes: routes,
})

router.beforeEach((to) => {
  if (!Object.prototype.hasOwnProperty.call(to?.meta, "requiresAuth")) {
    to.meta.requiresAuth = true;
  }

  const auth = useAuthStore();

  if (to.meta.requiresAuth && !auth.isLoggedIn) {
    return {
      name: "login",
      query: {redirect: to.fullPath},
    };
  }

  if (to.name === "login" && auth.isLoggedIn) {
    return {
      name: "home",
    };
  }

  axios.defaults.headers.common = {
    'Authorization': `Bearer ${auth.token}`,
    'Content-type': 'application/json',
    'Accept': 'application/json',
  }

  axios.interceptors.response.use(function (response) {
    return response;
  }, function (error) {
    if (error.response.status === 401) {
      auth.resetToken()
      router.push({name: "login"})
    }

    return Promise.reject(error.response.status);
  });
});

export default router;
