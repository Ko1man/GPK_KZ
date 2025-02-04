<template>
    <div class="card" v-if="news">
        <div class="card-body">
            <div class="post">
                <!-- 📝 Заголовок поста -->
                <div class="post-header">
                    <img :src="news.author.avatar || defaultAvatar" alt="Аватар автора" class="avatar">
                    <div class="post-info">
                        <span class="post-author">{{ news.author.name }}</span><br>
                        <span class="post-date">{{ formatDate(news.created_at) }}</span>
                    </div>
                    <div class="post-header-actions">
                        <a href="#"><i class="fas fa-ellipsis-h"></i></a>
                    </div>
                </div>

                <!-- 📄 Тело поста -->
                <div class="post-body">
                    <p>{{ news.full_description }}</p>
                    <img :src="`/storage/${news.image}`" class="post-image" alt="Изображение новости">
                </div>

                <!-- 💬 Действия (Лайк, Комментарии, Поделиться) -->
                <div class="post-actions">
                    <ul class="list-unstyled">
                        <li><a href="#" class="like-btn"><i class="far fa-heart"></i>Like</a></li>
                        <li><a href="#"><i class="far fa-comment"></i>Comment</a></li>
                        <li><a href="#"><i class="far fa-paper-plane"></i>Share</a></li>
                    </ul>
                </div>

                <!--Блок комментариев -->
                <div class="post-comments">
                    <div v-for="comment in news.comments" :key="comment.id" class="post-comm">
                        <img :src="comment.user.avatar || defaultAvatar" class="comment-img" alt="Аватар">
                        <div class="comment-container">
                            <span class="comment-author">
                                {{ comment.user.name }}
                                <small class="comment-date">{{ formatDate(comment.created_at) }}</small>
                            </span>
                        </div>
                        <span class="comment-text">{{ comment.text }}</span>
                    </div>

                    <!-- Форма добавления комментария -->
                    <div class="new-comment">
                        <div class="input-group mb-3">
                            <input v-model="newComment" type="text" class="form-control" placeholder="Введите комментарий..." aria-label="Комментарий">
                            <button @click="submitComment" class="btn btn-outline-secondary">Отправить</button>
                        </div>
                        <p v-if="commentError" class="error">{{ commentError }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div v-else-if="loading" class="loading">Загрузка...</div>
    <div v-else class="error">Ошибка: {{ error }}</div>
</template>

<script>
export default {
    data() {
        return {
            news: null,
            loading: true,
            error: null,
            newComment: "", // Поле ввода комментария
            commentError: null,
            defaultAvatar: "/assets/images/avatars/profile-image.png", // Аватар по умолчанию
        };
    },
    async created() {
        await this.fetchNews();
    },
    methods: {
        async fetchNews() {
            const newsId = this.$route.params.id;
            try {
                const response = await fetch(`http://127.0.0.1:8000/api/news/${newsId}`);
                if (!response.ok) {
                    throw new Error('Ошибка загрузки новости');
                }
                this.news = await response.json();
            } catch (err) {
                this.error = err.message;
            } finally {
                this.loading = false;
            }
        },
        async submitComment() {
            if (!this.newComment.trim()) return;

            const newsId = this.$route.params.id;
            try {
                const response = await fetch(`http://127.0.0.1:8000/api/comments`, {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ text: this.newComment, user_id: null }) // Заменить user_id на реального пользователя
                });

                if (!response.ok) {
                    throw new Error("Ошибка при отправке комментария");
                }

                const newComment = await response.json();
                this.news.comments.push(newComment); // Обновляем список комментариев
                this.newComment = ""; // Очищаем поле
                this.commentError = null;
            } catch (err) {
                this.commentError = err.message;
            }
        },
        formatDate(date) {
            return new Date(date).toLocaleString("ru-RU", { day: "numeric", month: "long", year: "numeric" });
        }
    }
};
</script>

<style scoped>
.card {
    max-width: 600px;
    margin: 0 auto;
    background: #fff;
    border-radius: 8px;
    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
}
.card-body {
    padding: 15px;
}
.post-header {
    display: flex;
    align-items: center;
    gap: 10px;
}
.avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
}
.post-info {
    flex-grow: 1;
}
.post-body img {
    width: 100%;
    border-radius: 8px;
    margin-top: 10px;
}
.post-actions ul {
    display: flex;
    justify-content: space-between;
    padding: 0;
}
.post-comments {
    margin-top: 15px;
}
.post-comm {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}
.comment-img {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    margin-right: 10px;
}
.new-comment {
    margin-top: 10px;
}
.error {
    color: red;
    text-align: center;
}
</style>
