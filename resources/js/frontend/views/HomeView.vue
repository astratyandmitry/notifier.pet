<script setup>
import _ from "lodash";
import axios from "axios";
import {computed, onMounted, ref} from "vue";
import Alert from "../components/Alert.vue";

const activeNotification = ref(null);
const notifications = ref([]);

onMounted(() => {
  axios.get('/api/client/notifications')
    .then(({data}) => {
      notifications.value = data.data

      if (notifications.value.length) {
        activeNotification.value = notifications.value[0];
      }
    });
})

const nextElement = () => {
  activeNotification.value = null;

  _.delay(() => {
    notifications.value.shift();

    if (notifications.value.length) {
      activeNotification.value = notifications.value[0];
    }
  }, 500);
}
</script>

<template>
  <div class="flex items-center justify-center h-screen">
    <h1 class="text-3xl font-light text-center p-12 text-gray-500">
      Notifier App
    </h1>
  </div>

  <transition
    enter-active-class="duration-100 ease-out"
    enter-from-class="transform opacity-0"
    enter-to-class="opacity-100"
    leave-active-class="duration-200 ease-in"
    leave-from-class="opacity-100"
    leave-to-class="transform opacity-0"
  >
    <Alert :notification="activeNotification" @close="nextElement()" />
  </transition>
</template>
