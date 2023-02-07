<script setup>
import {toast} from "vue3-toastify";
import {useRouter} from "vue-router";
import axios from "axios";
import {onMounted, ref} from "vue";

const router = useRouter();
const updating = router.currentRoute.value.params.id;

const form = ref({
  title: '',
  body: '',
  categories: [],
})

const categories = ref([]);

onMounted(() => {
  axios.get('/api/notification_categories')
    .then(response => {
      categories.value = response.data.data
    });

  if (updating) {
    axios.get(`/api/notifications/${router.currentRoute.value.params.id}`)
      .then(response => {
        form.value = response.data.data
        form.value.categories = response.data.data.categories.map(category => category.id)
      })
  }
})

const handleSubmit = () => {
  if (!form.value.title || !form.value.body || !form.value.categories.length) {
    return toast.error('Please fill all required fields')
  }

  if (updating) {
    axios.put(`/api/notifications/${router.currentRoute.value.params.id}`, form.value)
      .then(({data}) => {
        toast.success(data.message)
        router.push({name: 'notifications.list'})
      })
  } else {
    axios.post('/api/notifications', form.value)
      .then(({data}) => {
        toast.success(data.message)
        router.push({name: 'notifications.list'})
      })
  }
}
</script>

<template>
  <div class="form">
    <div class="field">
      <label for="title" class="label">Title <strong>*</strong></label>
      <input type="text" id="title" placeholder="Some notification" class="input" v-model="form.title" required>
    </div>

    <div class="field">
      <label for="body" class="label">Body <strong>*</strong></label>
      <textarea id="body" placeholder="Some body message" class="input" v-model="form.body" required></textarea>
    </div>

    <div class="field">
      <label for="categories" class="label">Category <strong>*</strong></label>
      <select id="categories" class="input" v-model="form.categories" multiple required>
        <option v-for="category in categories" :value="category.id">{{ category.title }}</option>
      </select>
    </div>

    <div class="flex justify-end">
      <button class="button" @click="handleSubmit">
        {{ updating ? 'Update Notification' : 'Store Notification' }}
      </button>
    </div>
  </div>
</template>
