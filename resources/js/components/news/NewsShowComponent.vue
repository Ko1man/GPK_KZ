<template>
    <div v-if="news" class="card">
        <div class="card-body">
            <div class="post">
                <div class="post-header">
                    <img :src="news.author_image || defaultAvatar" alt="Автор" />
                    <div class="post-info">
                        <span class="post-author">{{ news.author.name }}</span><br>
                        <span class="post-date">{{ news.created_at }}</span>
                    </div>
                    <div class="post-header-actions">
                        <a href="#"><i class="fas fa-ellipsis-h"></i></a>
                    </div>
                </div>
                <div class="post-body">
                    <h1>{{ news.title }}</h1>
                    <p>{{ news.full_description }}</p>
                    <img :src="news.image" class="post-image" alt="News Image" v-if="news.image" />
                </div>
                <div class="post-actions">
                    <ul class="list-unstyled">
                        <li>
                            <a href="#" class="like-btn"><i class="far fa-heart"></i> Like</a>
                        </li>
                        <li>
                            <a href="#"><i class="far fa-comment"></i> Comment</a>
                        </li>
                        <li>
                            <a href="#"><i class="far fa-paper-plane"></i> Share</a>
                        </li>
                    </ul>
                </div>
                <div class="post-comments">
                    <h3>Комментарии</h3>
                    <div v-if="comments.length">
                        <div v-for="comment in comments" :key="comment.id" class="post-comm">
                            <img :src="comment.user_image || defaultAvatar" class="comment-img" alt="User" />
                            <div class="comment-container">
                                <span class="comment-author">
                                    {{ comment.user.name }}
                                    <small class="comment-date">{{ comment.created_at }}</small>
                                </span>
                            </div>
                            <span class="comment-text">
                                {{ comment.comment }}
                            </span>
                        </div>
                    </div>
                    <p v-else>Комментариев пока нет</p>

                    <div v-if="isAuthenticated" class="new-comment">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" v-model="newComment" placeholder="Напишите комментарий" />
                            <button class="btn btn-outline-secondary" @click="addComment">Отправить</button>
                        </div>
                    </div>
                    <p v-else class="text-muted">Войдите, чтобы оставить комментарий.</p>

                    <div>
                        <small>Просмотры: {{ news.view_count }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <p v-else>Загрузка...</p>
</template>

<script setup>
import { ref, onMounted, computed } from "vue";
import { useRoute } from "vue-router";
import axios from "axios";

const route = useRoute();
const news = ref(null);
const comments = ref([]); // Храним загруженные комментарии
const newComment = ref("");
const defaultAvatar = "/assets/images/avatars/profile-image.png";

const fetchNews = async () => {
    try {
        const response = await axios.get(`/api/news/${route.params.id}`);
        news.value = response.data;
        fetchComments(); // Загружаем комментарии после загрузки новости
    } catch (error) {
        console.error("Ошибка загрузки новости:", error);
    }
};

const fetchComments = async () => {
    try {
        const response = await axios.get(`/api/comments/${route.params.id}`);
        comments.value = response.data;
    } catch (error) {
        console.error("Ошибка загрузки комментариев:", error);
    }
};

const isAuthenticated = computed(() => !!localStorage.getItem("token"));

async function addComment() {
    try {
        const response = await fetch("/api/comments", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Authorization": `Bearer ${localStorage.getItem("token")}`
            },
            body: JSON.stringify({
                comment: newComment.value,
                news_id: news.value.id
            })
        });

        const data = await response.json();
        if (response.ok) {
            console.log("Комментарий добавлен", data);

            // Добавляем новый комментарий в массив
            comments.value.push({
                id: data.comment.id,
                user: { name: "Вы" }, // Так как сервер не возвращает user, пишем "Вы"
                comment: newComment.value,
                created_at: "Только что"
            });

            newComment.value = ""; // Очищаем поле ввода
        } else {
            console.error("Ошибка:", data);
        }
    } catch (error) {
        console.error("Ошибка при отправке комментария:", error);
    }
}

onMounted(fetchNews);
</script>

<style scoped>
.card {
    margin: 20px;
}
.post-header {
    display: flex;
    align-items: center;
}
.post-header img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin-right: 10px;
}
.post-image {
    width: 100%;
    margin-top: 10px;
}
.comment-img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
}
</style>
