<script setup>
import {onMounted, ref} from "vue";

const groupData = ref({
    name: "",
    department_id: "",
    course_id: "",
});

const departments = ref([]); // Отделы
const courses = ref([]); // Курсы
const errors = ref({});
const isLoading = ref(false);

// Получение списка отделов
const fetchDepartments = async () => {
    try {
        const response = await fetch("http://127.0.0.1:8000/api/departments");
        departments.value = await response.json(); // Заполняем массив
    } catch (error) {
        console.error("Ошибка при загрузке отделов", error);
    }
};

// Получение списка курсов
const fetchCourses = async () => {
    try {
        const response = await fetch("http://127.0.0.1:8000/api/courses");
        courses.value = await response.json();
    } catch (error) {
        console.error("Ошибка при загрузке курсов", error);
    }
};

// Загружаем данные при старте
onMounted(() => {
    fetchDepartments();
    fetchCourses();
});

// Функция для создания группы
const createGroup = async () => {
    isLoading.value = true;
    errors.value = {};

    try {
        const response = await fetch("http://127.0.0.1:8000/api/groups/create", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                Authorization: `Bearer ${localStorage.getItem("token")}`,
            },
            body: JSON.stringify(groupData.value),
        });

        if (!response.ok) {
            const errorData = await response.json();
            errors.value = errorData.errors || { general: "Ошибка сервера" };
            throw new Error("Ошибка при создании группы");
        }

        alert("Группа успешно создана!");
        groupData.value = { name: "", department_id: "", course_id: "" };
        window.location.port = ('/news')
    } catch (error) {
        console.error(error);
    } finally {
        isLoading.value = false;
    }
};
</script>

<template>
    <div class="form-container">
        <h2>Создать группу</h2>

        <form @submit.prevent="createGroup">
            <div class="input-group">
                <label>Название группы:</label>
                <input v-model="groupData.name" type="text" required placeholder="Введите название группы" />
                <p v-if="errors.name" class="error">{{ errors.name[0] }}</p>
            </div>

            <div class="input-group">
                <label>Отдел:</label>
                <select v-model="groupData.department_id" required>
                    <option value="" disabled>Выберите отдел</option>
                    <option v-for="department in departments" :key="department.id" :value="department.id">
                        {{ department.name }}
                    </option>
                </select>
                <p v-if="errors.department_id" class="error">{{ errors.department_id[0] }}</p>
            </div>

            <div class="input-group">
                <label>Курс:</label>
                <select v-model="groupData.course_id" required>
                    <option value="" disabled>Выберите курс</option>
                    <option v-for="course in courses" :key="course.id" :value="course.id">
                        {{ course.course }}
                    </option>
                </select>
                <p v-if="errors.course_id" class="error">{{ errors.course_id[0] }}</p>
            </div>

            <button type="submit" :disabled="isLoading">
                {{ isLoading ? "Создание..." : "Создать группу" }}
            </button>
            <p v-if="errors.general" class="error">{{ errors.general }}</p>
        </form>
    </div>
</template>

<style scoped>
.form-container {
    max-width: 420px;
    margin: auto;
    padding: 25px;
    border-radius: 12px;
    background: #ffffff;
    box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}

.input-group {
    margin-bottom: 15px;
}

label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
    color: #555;
}

input, select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 16px;
    transition: border-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
}

input:focus, select:focus {
    border-color: #007bff;
    box-shadow: 0px 0px 8px rgba(0, 123, 255, 0.3);
    outline: none;
}

button {
    background: linear-gradient(135deg, #007bff, #0056b3);
    color: white;
    padding: 12px;
    width: 100%;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 16px;
    font-weight: bold;
    transition: background 0.3s ease-in-out, transform 0.2s ease-in-out;
}

button:hover {
    background: linear-gradient(135deg, #0056b3, #003f7f);
    transform: scale(1.05);
}

button:disabled {
    background: gray;
    cursor: not-allowed;
}

.error {
    color: red;
    font-size: 12px;
    margin-top: 5px;
}
</style>
