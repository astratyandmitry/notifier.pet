<script setup>
import {ref} from "vue";

const message = ref("Hello from Frontend");
</script>

<template>
  <h1 class="text-2xl text-center p-12 logotype">
    {{ message }}
  </h1>
</template>

<style lang="postcss" scoped>

</style>
