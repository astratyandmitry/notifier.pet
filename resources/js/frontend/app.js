import {createApp} from "vue";
import {createPinia} from "pinia";
import Frontend from "./Frontend.vue";
import Vue3Toastify from 'vue3-toastify';
import axios from "axios";

import './app.css';
import 'vue3-toastify/dist/index.css';

axios.defaults.baseURL = import.meta.env.VITE_API_URL;

const app = createApp(Frontend)

app.use(createPinia())
app.use(Vue3Toastify, {
  autoClose: 3000,
});

app.mount('#app');
