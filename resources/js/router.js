import {createWebHistory, createRouter} from "vue-router";
import NewsIndexComponent from "@/components/news/NewsIndexComponent.vue";
import NewsShowComponent from "@/components/news/NewsShowComponent.vue";

const routes = [
    {path: "/news",
      component:  NewsIndexComponent,
        name: "news.index"},
    {
        path: "/news/:id",
    component: NewsShowComponent,
    name: "news.show",
    props:true}
]
const router = createRouter({
    history: createWebHistory(),
    routes
})
export default router
