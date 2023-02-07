<script setup>
import AppHeader from "./components/UI/AppHeader.vue";
import {useRouter} from "vue-router";
import {ref, watch} from "vue";

const displayHeader = ref(false);
const router = useRouter();

watch(
  router.currentRoute,
  (route) => {
    displayHeader.value = route.name !== "login";
  },
  { deep: true, immediate: true }
);
</script>

<template>
  <div class="app">
    <AppHeader v-show="displayHeader" />

    <main class="main">
      <div class="container mx-auto px-4">
        <router-view />
      </div>
    </main>
  </div>
</template>

<style lang="postcss" scoped>
.app {
  @apply w-full min-h-screen bg-gray-50 antialiased pt-[60px];
}

.main {
  @apply py-12 min-h-screen;
}
</style>
