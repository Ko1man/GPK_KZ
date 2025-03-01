import './bootstrap';
import { createApp } from 'vue'
import App from './components/App.vue';
import router from "@/router";
import Register from "@/components/Register.vue";
import AttentionComponent from "@/components/attentions/AttentionComponent.vue";
import AdminRegister from "@/components/AdminRegister.vue";
import CreateGroupsComponent from "@/components/groups/CreateGroupsComponent.vue";
import ListGroupsComponent from "@/components/groups/ListGroupsComponent.vue";

const app = createApp(App);
app.use(router);
app.mount("#app");
const reg = createApp(Register)
reg.mount("#reg")
const att = createApp(AttentionComponent)
att.mount("#att")
const admin = createApp(AdminRegister);
admin.mount("#admin")
const group = createApp(CreateGroupsComponent)
group.mount("#group")
const GroupList = createApp(ListGroupsComponent)
GroupList.mount("#list")


const token = localStorage.getItem("token");
if (token) {
    axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;
}



