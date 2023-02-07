<script setup>
import CategoriesForm from "../components/Categories/CategoriesForm.vue";
import AppPage from "../components/UI/AppPage.vue";
</script>

<template>
  <AppPage>
    <template #title>
      Client Management
    </template>

    <CategoriesForm />
  </AppPage>
</template>
