import {createWebHistory, createRouter} from "vue-router";
import NewsIndexComponent from "@/components/news/NewsIndexComponent.vue";
import NewsShowComponent from "@/components/news/NewsShowComponent.vue";
import AttentionComponent from "@/components/attentions/AttentionComponent.vue";
import CreateGroupsComponent from "@/components/groups/CreateGroupsComponent.vue";

const routes = [
    {path: "/news",
      component:  NewsIndexComponent,
        name: "news.index"},
    {
        path: "/news/:id",
    component: NewsShowComponent,
    name: "news.show",
    props:true},
    {
        path: "/attention/:id",
        component: AttentionComponent,
        name: "attention"
    },
    {
        path: "/groups/create",
        component: CreateGroupsComponent,
        name: "CreateGroups"
    }
]
const router = createRouter({
    history: createWebHistory(),
    routes
})
export default router
