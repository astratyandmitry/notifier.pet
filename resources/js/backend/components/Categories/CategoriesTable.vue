<script setup>
import {toast} from "vue3-toastify";
import axios from "axios";

const props = defineProps({
  categories: {
    type: Array,
    default: () => [],
  },
});

const handleDelete = (id) => {
  axios.delete(`/api/notification_categories/${id}`)
    .then(({ data }) => toast.success(data.message))
    .catch((error) => toast.error(error.response.data.message));
};
</script>

<template>
  <table class="table">
    <thead>
    <tr>
      <th class="th w-16">
        ID
      </th>
      <th class="th">
        Name
      </th>
      <th class="th w-20"></th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="category in props.categories" :key="category.id" class="hover:bg-gray-50 group border-t">
      <td class="td">
        {{ category.id }}
      </td>
      <td class="td">
        {{ category.title }}
      </td>
      <td class="td whitespace-nowrap">
        <div class="actions">
          <RouterLink :to="{ name: 'categories.edit', params: { id: category.id } }" class="button-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
              <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32l8.4-8.4z" />
              <path d="M5.25 5.25a3 3 0 00-3 3v10.5a3 3 0 003 3h10.5a3 3 0 003-3V13.5a.75.75 0 00-1.5 0v5.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5V8.25a1.5 1.5 0 011.5-1.5h5.25a.75.75 0 000-1.5H5.25z" />
            </svg>
          </RouterLink>

          <button class="button-icon" @click="handleDelete(category.id)">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
              <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.72 6.97a.75.75 0 10-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 101.06 1.06L12 13.06l1.72 1.72a.75.75 0 101.06-1.06L13.06 12l1.72-1.72a.75.75 0 10-1.06-1.06L12 10.94l-1.72-1.72z" clip-rule="evenodd" />
            </svg>
          </button>
        </div>
      </td>
    </tr>
    </tbody>
  </table>
</template>

<style lang="postcss" scoped>
.table {
  @apply w-full bg-white border-collapse border border-gray-200 rounded overflow-hidden drop-shadow-xl;
}

.th {
  @apply p-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider;
}

.td {
  @apply p-3 text-sm text-gray-900;
}

.actions {
  @apply flex items-center justify-around opacity-0 group-hover:opacity-100 space-x-1;
}
</style>
