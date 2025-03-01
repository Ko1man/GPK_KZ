<script setup>
import {onMounted, ref} from "vue";

const groups = ref([]); // Массив для хранения групп
const isLoading = ref(true);
const error = ref(null);

// Функция для загрузки групп из API
const fetchGroups = async () => {
    try {
        const response = await fetch("http://127.0.0.1:8000/api/groups");
        if (!response.ok) throw new Error("Ошибка при загрузке групп");

        groups.value = await response.json();
    } catch (err) {
        error.value = err.message;
    } finally {
        isLoading.value = false;
    }
};

// Загружаем группы при старте
onMounted(fetchGroups);
</script>

<template>
    <div class="container">
        <h2>Список групп</h2>

        <!-- Сообщение об ошибке -->
        <p v-if="error" class="error">{{ error }}</p>

        <!-- Прелоадер -->
        <p v-if="isLoading">Загрузка групп...</p>

        <!-- Карточки групп -->
        <div v-if="groups.length" class="grid">
            <div v-for="group in groups" :key="group.id" class="card">
                <h3>{{ group.name }}</h3>
                <p><strong>Курс:</strong> {{ group.course.name }}</p>
                <p><strong>Отдел:</strong> {{ group.department.name }}</p>
            </div>
        </div>

        <p v-else-if="!isLoading">Группы не найдены</p>
    </div>
</template>

<style scoped>
.container {
    max-width: 800px;
    margin: auto;
    padding: 20px;
}

h2 {
    text-align: center;
    color: #333;
}

.grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 15px;
    margin-top: 20px;
}

.card {
    background: #fff;
    padding: 15px;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.2);
}

h3 {
    color: #007bff;
    margin-bottom: 10px;
}

p {
    color: #555;
    font-size: 14px;
}

.error {
    color: red;
    text-align: center;
    font-weight: bold;
}
</style>

