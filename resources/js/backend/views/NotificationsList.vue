<script setup>
import NotificationsTable from "../components/Notifications/NotificationsTable.vue";
import LoadingScreen from "../components/UI/LoadingScreen.vue";
import AppPage from "../components/UI/AppPage.vue";
import {useLoading} from "../use/loading";
import {onMounted, ref} from "vue";
import axios from "axios";

const { loading, startLoading, stopLoading } = useLoading();

const notifications = ref([]);

onMounted(() => fetchClients())

const fetchClients = async () => {
  startLoading()

  const response = await axios.get('/api/notifications');

  notifications.value = response.data.data;

  stopLoading()
}
</script>

<template>
  <AppPage>
    <template #title>
      Notifications List
    </template>

    <template #actions>
      <RouterLink :to="{ name: 'notifications.create' }" class="button">
        Add
      </RouterLink>
    </template>

    <LoadingScreen :loading="loading" :count="notifications.length">
      <NotificationsTable :notifications="notifications" />
    </LoadingScreen>
  </AppPage>
</template>
