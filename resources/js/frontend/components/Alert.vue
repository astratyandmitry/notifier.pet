<script setup>
import axios from "axios";
import {ref, watch} from "vue";

const emit = defineEmits(['close'])

const props = defineProps({
  notification: Object,
})

let timeout = null;

watch(() => props.notification, (value) => {
  if (value) {
    notification.value = value;

    timeout = setTimeout(handleClose, 5000);
  }
});

const notification = ref(null);

const handleClose = () => {
  axios.post(`/api/client/notifications/${notification.value.id}/read`)
    .then(() => {
      emit('close');

      clearTimeout(timeout);
    })
}

const handleUnsubscribe = () => {
  axios.post(`/api/client/notification-settings/${props.notification.id}/unsubscribe`).then(handleClose)
}
</script>

<template>
  <div class="fixed inset-x-0 bottom-8 flex z-50" v-show="props.notification">
    <div class="w-[640px] mx-auto rounded p-4 bg-indigo-100 text-indigo-700 drop-shadow-sm">
      <div class="flex items-center justify-between">
        <strong class="mb-2 block">{{ notification?.title }}</strong>

        <button @click="handleClose">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
               stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      <p class="text-sm">{{ notification?.body }}</p>
      <p>
        <button @click="handleUnsubscribe" class="text-xs bg-indigo-200 hover:bg-indigo-300 px-3 py-2 rounded mt-2">Do
          not show messages like this
        </button>
      </p>
    </div>
  </div>
</template>

<style lang="postcss" scoped>

</style>
