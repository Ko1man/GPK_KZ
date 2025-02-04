<template>
    <div>
        <h1>Новости</h1>
        <router-view></router-view> <!-- Тут рендерятся страницы -->
    </div>

</template>

<script>
import NewsComponent from "@/components/NewsComponent.vue";

export default {
    components: {
        NewsComponent
    },
};
</script>
