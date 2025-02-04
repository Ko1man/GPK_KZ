<template>
  <div class="container">
    <h1 class="title">Новости</h1>
    <div v-if="loading">Загрузка...</div>
    <div v-else-if="error" class="error">{{ error }}</div>
    <div v-else class="news-grid">
      <div v-for="news in newsList" :key="news.id" class="news-card">
        <img :src="getImageUrl(news.image)" alt="News Image" class="news-image" />
        <h2 class="news-title">{{ news.title }}</h2>
        <p class="news-description">{{ news.short_description }}</p>
        <router-link :to="'/news/' + news.id" class="btn">Подробнее</router-link>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import { ref, onMounted } from "vue";

export default {
  setup() {
    const newsList = ref([]);
    const loading = ref(true);
    const error = ref(null);

    // Функция загрузки новостей
    const fetchNews = async () => {
      try {
        let response = await axios.get("http://127.0.0.1:8000/api/news");
        newsList.value = response.data;
      } catch (err) {
        error.value = "Ошибка загрузки новостей";
        console.error(err);
      } finally {
        loading.value = false;
      }
    };

    // Функция получения URL картинки из storage
    const getImageUrl = (imagePath) => {
      return `http://127.0.0.1:8000/storage/${imagePath}`;
    };

    onMounted(fetchNews);

    return { newsList, loading, error, getImageUrl };
  },
};
</script>

<style scoped>
.container {
  max-width: 900px;
  margin: 0 auto;
  padding: 20px;
}

.title {
  text-align: center;
  margin-bottom: 20px;
}

.news-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
  gap: 20px;
}

.news-card {
  border: 1px solid #ddd;
  border-radius: 8px;
  padding: 15px;
  box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
}

.news-image {
  width: 100%;
  height: 150px;
  object-fit: cover;
  border-radius: 8px;
}

.news-title {
  font-size: 18px;
  margin: 10px 0;
}

.news-description {
  color: #666;
}
</style>

