<script setup>
import {ref} from "vue";

const message = ref("Hello from Frontend");
</script>

<template>
  <div class="min-h-screen w-full antialiased bg-white">
    <RouterView />
  </div>
</template>

<style lang="postcss" scoped>

</style>
