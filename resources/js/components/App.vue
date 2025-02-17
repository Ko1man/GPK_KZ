<template>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        <div v-for="item in news" :key="item.id" class="border rounded-lg shadow p-2 w-60">
            <img :src="`/storage/${item.image}`" alt="News Image" class="w-full h-32 object-cover rounded-md" />
            <h3 class="text-md font-semibold mt-2">{{ item.title }}</h3>
            <p class="text-gray-600 text-sm">{{ item.short_description }}</p>
            <button @click="goToShow(item.id)" class="mt-2 px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 text-sm">
                Читать далее
            </button>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';

const news = ref([]);
const router = useRouter();

onMounted(async () => {
    try {
        const response = await axios.get('/api/news');
        news.value = response.data;
    } catch (error) {
        console.error('Ошибка загрузки новостей:', error);
    }
});

const goToShow = (id) => {
    router.push(`/news/${id}`);
};
</script>

<style scoped>

</style>
