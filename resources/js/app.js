import "./bootstrap";

import { createApp } from "vue";
import { createPinia } from "pinia";
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

//import the root component App from a single-file component.
import App from "./layouts/App.vue";
import router from "./router.js";

const
    pinia = createPinia();
const app = createApp(App);

const options = {
    transition: "Vue-Toastification__bounce",
    maxToasts: 20,
    newestOnTop: true,
    position: 'top-center', 
    timeout: 2000 
};


app.use(pinia)
    .use(router)
    .use(Toast, options)
    .mount("#app");
