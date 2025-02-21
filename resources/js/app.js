import './bootstrap';
import { createApp } from 'vue'
import App from './components/App.vue';
import router from "@/router";
import Register from "@/components/Register.vue";
import AttentionComponent from "@/components/attentions/AttentionComponent.vue";

const app = createApp(App);
app.use(router);
app.mount("#app");
const reg = createApp(Register)
reg.mount("#reg")
const att = createApp(AttentionComponent)
att.mount("#att")

const token = localStorage.getItem("token");
if (token) {
    axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;
}



