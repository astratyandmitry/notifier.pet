<script setup>
import {RouterLink, useRouter} from "vue-router";
import {useAuthStore} from "../../store";

const router = useRouter();
const authStore = useAuthStore();

const logout = () => {
  authStore.logout()
    .then(() => router.push({name: "login"}))
}
</script>

<template>
  <header class="header">
    <div class="container mx-auto px-4">
      <div class="content">
        <div class="content-left">

          <h1 class="logotype">
            <span class="text-indigo-600">Notifier</span>Admin
          </h1>

          <ul class="menu">
            <li class="menu-item">
              <RouterLink class="menu-button" :to="{ name: 'notifications.list' }">
                Notifications
              </RouterLink>
            </li>
            <li class="menu-item">
              <RouterLink class="menu-button" :to="{ name: 'categories.list' }">
                Categories
              </RouterLink>
            </li>
          </ul>
        </div>

        <div class="content-right">
          <ul class="menu">
            <li class="menu-item">
              <button class="menu-button" @click="logout">
                Logout
              </button>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </header>
</template>

<style lang="postcss" scoped>
.header {
  @apply z-30 backdrop-blur-sm bg-white/30 border-b border-black border-opacity-10 py-3 fixed inset-x-0 top-0;
}

.logotype {
  @apply text-2xl font-semibold text-gray-700;
}

.content {
  @apply flex items-center justify-between space-x-12;
}

.content-left {
  @apply flex items-center space-x-8;
}

.menu {
  @apply flex items-center justify-end flex-1 space-x-3;
}

.menu-button {
  @apply text-sm px-4 py-2 bg-black bg-opacity-0 hover:bg-opacity-[0.05] rounded text-gray-600 hover:text-indigo-600;
}

.menu-button.router-link-active {
  @apply bg-indigo-600 text-indigo-700 bg-opacity-10;
}
</style>
