<script setup>
import {ref, onMounted} from "vue";
import {useRouter} from "vue-router";
const newsCard = ref([]);
const router =useRouter()

onMounted(()=>{
    fetch('http://127.0.0.1:8000/api/news')
        .then(response =>response.json())
        .then(data =>{
            newsCard.value =data
        })
        .catch(error => {
            console.error("Ошибка при загрузке новостей:", error);
        });
});
const getImageUrl = (image) => {
    return `http://127.0.0.1:8000/storage/${image}`;
};
const goToNews = (id) => {
  router.push({ name: 'news.show', params: { id } });
};


</script>

<template>
    <div class="col-md-3">
        <div class="row">
            <div class="news-container">
                <div class="news-card" v-for="(news,index) in newsCard" :key="index">
                    <img :src="getImageUrl(news.image)" alt="News Image" class="news-image"/>
                    <div class="news-card-header">{{news.title}}</div>
                    <div class="news-card-body">
                        <p>{{ news.short_description }}</p>
                    </div>
                  <button class="btn btn-primary" @click="goToNews(news.id)">Подробнее</button>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.news-container {
    text-align: center;
    margin: 20px;
}

.news-cards {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
}

.news-card {
    background: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    transition: transform 0.3s;
}

.news-card:hover {
    transform: scale(1.05);
}

.news-card-header h3 {
    font-size: 1.5em;
    margin-bottom: 10px;
}
.news-image{
    height: 200px;
    width: 260px;
}

.news-card-body p {
    font-size: 1em;
    color: #555;
}
</style>

