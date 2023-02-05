import {computed, ref} from "vue";
import {defineStore} from "pinia";
import {toast} from "vue3-toastify";
import axios from "axios";

export const useAuthStore = defineStore("auth", () => {
  const user = ref(localStorage.getItem("admin") ? JSON.parse(localStorage.getItem("admin")) : null);

  const isLoggedIn = computed(() => user.value?.token);
  const token = computed(() => user.value?.token);

  const login = (email, password) => {
    return new Promise((resolve, reject) => {
      axios.post(`/api/auth/login`, {email, password})
        .then(({data}) => {
          user.value = data;
          localStorage.setItem("admin", JSON.stringify(user.value));

          resolve(true);
        })
        .catch((error) => {
          toast.error(error.response.data.message);

          reject(false);
        });
    });
  };

  const logout = () => {
    return new Promise((resolve, reject) => {
      axios.post(`/api/auth/logout`)
        .then(() => {
          resetToken()

          resolve(true);
        })
        .catch((error) => {
          toast.error(error.response.data.message);

          reject(false);
        });
    });
  };

  const resetToken = () => {
    user.value = null;
    localStorage.removeItem("admin");
  }

  return {
    isLoggedIn, token, resetToken, login, logout,
  };
});
