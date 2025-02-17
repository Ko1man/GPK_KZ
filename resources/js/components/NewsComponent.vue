<script setup>

</script>
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
<template>

</template>

<style scoped>

</style>
