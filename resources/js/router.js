import { createRouter, createWebHistory } from "vue-router";
import showNewsComponent from "@/components/showNewsComponent.vue";
import NewsComponent from "@/components/NewsComponent.vue";


const routes = [
    { path: "/news", component: NewsComponent },
    { path: "/news/:id", component: showNewsComponent },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
