import {createApp} from "vue";
import {createPinia} from "pinia";
import Frontend from "./Frontend.vue";
import router from "./router";
import axios from "axios";

import './app.css';

axios.defaults.baseURL = import.meta.env.VITE_API_URL;

const app = createApp(Frontend)

app.use(router);
app.use(createPinia())

app.mount('#app');
