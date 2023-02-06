<script setup lang="ts">
import axios from "axios";

axios.get('/api/client/notifications')
  .then(({ data }) => console.log(data));
</script>

<template>
  <div class="flex items-center justify-center h-screen">
    <h1 class="text-3xl font-light text-center p-12 text-gray-500">
      Notifier App
    </h1>
  </div>
</template>

<style lang="postcss" scoped>

</style>
