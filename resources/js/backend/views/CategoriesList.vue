<script setup>
import CategoriesTable from "../components/Categories/CategoriesTable.vue";
import LoadingScreen from "../components/UI/LoadingScreen.vue";
import AppPage from "../components/UI/AppPage.vue";
import {useLoading} from "../use/loading";
import {onMounted, ref} from "vue";
import axios from "axios";

const { loading, startLoading, stopLoading } = useLoading();

const categories = ref([]);

onMounted(() => fetchClients())

const fetchClients = async () => {
  startLoading()

  const response = await axios.get('/api/notification_categories');

  categories.value = response.data.data;

  stopLoading()
}
</script>

<template>
  <AppPage>
    <template #title>
      Categories List
    </template>

    <template #actions>
      <RouterLink :to="{ name: 'categories.create' }" class="button">
        Add
      </RouterLink>
    </template>

    <LoadingScreen :loading="loading" :count="categories.length">
      <CategoriesTable :categories="categories" />
    </LoadingScreen>
  </AppPage>
</template>
