<script setup>
import {toast} from "vue3-toastify";
import {useRouter} from "vue-router";
import axios from "axios";
import {onMounted, ref} from "vue";

const router = useRouter();
const updating = router.currentRoute.value.params.id;

const form = ref({
  title: '',
})

onMounted(() => {
  if (updating) {
    axios.get(`/api/notification_categories/${router.currentRoute.value.params.id}`)
      .then(response => {
        form.value = response.data.data
      })
  }
})

const handleSubmit = () => {
  if (!form.value.title) {
    return toast.error('Please fill all required fields')
  }

  if (updating) {
    axios.put(`/api/notification_categories/${router.currentRoute.value.params.id}`, form.value)
      .then(({data}) => {
        toast.success(data.message)
        router.push({name: 'categories.list'})
      })
  } else {
    axios.post('/api/notification_categories', form.value)
      .then(({data}) => {
        toast.success(data.message)
        router.push({name: 'categories.list'})
      })
  }
}
</script>

<template>
  <div class="form">
    <div class="field">
      <label for="title" class="label">Title <strong>*</strong></label>
      <input type="text" id="title" placeholder="Some category" class="input" v-model="form.title" required>
    </div>

    <div class="flex justify-end">
      <button class="button" @click="handleSubmit">
        {{ updating ? 'Update Category' : 'Store Category' }}
      </button>
    </div>
  </div>
</template>
