<template>
    <div>
        <h2>Список событий</h2>
        <div class="card">
        <div v-if="!items.length">Загрузка...</div>

        <table class="table" v-else>
            <thead>
            <tr>
                <th>Имя</th>
                <th>Группа</th>
                <th>Дата</th>
                <th>Присутствовал</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in items" :key="item.id">
                <td>{{ item.user?.name || 'Не указан' }}</td>
                <td>{{ item.group?.name || 'Не указана' }}</td>
                <td>{{ item.date }}</td>
                <td>
                   <span :class="{'text-green-500': item.attention === 1, 'text-red-500': item.attention === 0}">
                            {{ item.attention === 1 ? 'Да' : item.attention === 0 ? 'Нет' : '' }}
                   </span>
                </td>
                <td>
                    <button class="btn btn-success btn-sm" @click="setAttendance(item, 1)">Да</button>
                    <button class="btn btn-danger btn-sm" @click="setAttendance(item, 0)">Нет</button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const items = ref([]);

// Получаем список событий с вложенными данными user и group
const fetchItems = async () => {
    try {
        const response = await axios.get('/api/attention');
        // Если API возвращает { success: true, data: [...] }
        items.value = response.data.data;
    } catch (error) {
        console.error('Ошибка получения данных', error);
    }
};

onMounted(() => {
    fetchItems();
});

// Функция для обновления статуса присутствия через API
const setAttendance = async (item, attentionValue) => {
    try {
        // Обратите внимание, что в вашем случае поле называется "attention"
        const response = await axios.put(`/api/attention/${item.id}`, { attention: attentionValue });
        item.attention = attentionValue;
        console.log('Статус обновлён', response.data);
        window.update()
    } catch (error) {
        console.error('Ошибка обновления статуса', error);
    }
};
</script>

<style scoped>
.table {
    margin-top: 20px;
}
</style>
