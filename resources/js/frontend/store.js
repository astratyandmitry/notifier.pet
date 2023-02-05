import {computed, ref} from "vue";
import {defineStore} from "pinia";
import {toast} from "vue3-toastify";
import axios from "axios";

export const useAuthStore = defineStore("auth", () => {
  const user = ref(localStorage.getItem("user") ? JSON.parse(localStorage.getItem("user")) : null);

  const isLoggedIn = computed(() => user.value?.token);
  const token = computed(() => user.value?.token);

  const login = (email, password) => {
    return new Promise((resolve, reject) => {
      axios.post(`/api/client/auth/login`, {email, password})
        .then(({data}) => {
          user.value = data;
          localStorage.setItem("user", JSON.stringify(user.value));

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
      axios.post(`/api/client/auth/logout`)
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
    localStorage.removeItem("user");
  }

  return {
    isLoggedIn, token, resetToken, login, logout,
  };
});
