<script setup>
import { computed, reactive } from "vue";
import { useRouter } from "vue-router";
import {useAuthStore} from "../store";

const data = reactive({
  email: "",
  password: "",
});

const disabled = computed(() => {
  return data.email.trim() === '' || data.password.trim() === '';
});

const router = useRouter();
const auth = useAuthStore();

const login = () => {
  if (disabled.value) {
    return;
  }

  auth
    .login(data.email, data.password)
    .then(() =>
      router.push({
        path: (router.currentRoute.value.query.redirect) ?? "/",
      })
    )
    .catch(() => {
      data.value.password = "";
    });
};
</script>

<template>
  <div class="min-h-screen flex w-full items-center justify-center">
    <div class="form w-[400px] mx-auto space-y-4">
      <div class="field">
        <input
          v-model.trim="data.email"
          id="email"
          type="text"
          placeholder="E-mail"
          class="input"
          required
          @keydown.enter="login"
        />
      </div>

      <div>
        <input
          v-model="data.password"
          id="password"
          type="password"
          placeholder="Password"
          class="input"
          required
          @keydown.enter="login"
        />
      </div>

      <div>
        <button class="button w-full" :disabled="disabled" @click="login">
          Login
        </button>
      </div>
    </div>
  </div>
</template>
