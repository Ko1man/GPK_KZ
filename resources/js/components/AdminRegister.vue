<template>
    <div class="row">
        <div class="col-md-5 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="authent-logo text-center">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRZKI4TQbK_XyVGN1uKh1axEytNq6iWqOSFXQ&s"
                             style="height: 100px; width: 100px;"
                             alt="Логотип">
                    </div>
                    <div class="authent-text text-center">
                        <p>Добро пожаловать на GPK.kz</p>
                        <p>Введите данные для создания аккаунта</p>
                    </div>

                    <form @submit.prevent="register">
                        <!-- ФИО в одну строку -->
                        <div class="row mb-3">
                            <div class="col">
                                <input type="text" class="form-control" v-model="form.last_name" placeholder="Фамилия" required>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" v-model="form.name" placeholder="Имя" required>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" v-model="form.second_name" placeholder="Отчество">
                            </div>
                        </div>

                        <!-- Остальные поля -->
                        <div class="mb-3" v-for="(field, key) in formFields" :key="key">
                            <div class="form-floating">
                                <input :type="field.type" class="form-control" v-model="form[key]" :id="key" :placeholder="field.label" required>
                                <label :for="key">{{ field.label }}</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="group">Группа</label>
                            <select class="form-control" v-model="form.group_id" required>
                                <option value="" disabled>Выберите группу</option>
                                <option v-for="group in groups" :key="group.id" :value="group.id">
                                    {{ group.name }}
                                </option>
                            </select>
                        </div>

                        <!-- Дата рождения -->
                        <div class="form-group mb-3">
                            <label>Дата рождения</label>
                            <div class="d-flex">
                                <select class="form-control me-2" v-model="birth_day" required>
                                    <option value="">День</option>
                                    <option v-for="day in 31" :key="day" :value="day">{{ day }}</option>
                                </select>
                                <select class="form-control me-2" v-model="birth_month" required>
                                    <option value="">Месяц</option>
                                    <option v-for="(month, index) in months" :key="index" :value="index + 1">{{ month }}</option>
                                </select>
                                <select class="form-control" v-model="birth_year" required>
                                    <option value="">Год</option>
                                    <option v-for="year in birthYears" :key="year" :value="year">{{ year }}</option>
                                </select>
                            </div>
                        </div>

                        <!-- Дата поступления -->
                        <div class="form-group mb-3">
                            <label>Дата поступления</label>
                            <div class="d-flex">
                                <select class="form-control me-2" v-model="admission_day" required>
                                    <option value="">День</option>
                                    <option v-for="day in 31" :key="day" :value="day">{{ day }}</option>
                                </select>
                                <select class="form-control me-2" v-model="admission_month" required>
                                    <option value="">Месяц</option>
                                    <option v-for="(month, index) in months" :key="index" :value="index + 1">{{ month }}</option>
                                </select>
                                <select class="form-control" v-model="admission_year" required>
                                    <option value="">Год</option>
                                    <option v-for="year in birthYears" :key="year" :value="year">{{ year }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import {ref, computed, onMounted} from 'vue';
import axios from 'axios';

const form = ref({
    name: '',
    second_name: '',
    last_name: '',
    address: '',
    group_id: '',
    phone: '',
    email: '',
    role: '',
    password: '',
    password_confirmation: '',
    date_of_birth: '',
    date_of_admission: ''
});

// Дата рождения
const birth_day = ref('');
const birth_month = ref('');
const birth_year = ref('');

// Дата поступления
const admission_day = ref('');
const admission_month = ref('');
const admission_year = ref('');

// Объединяем дату рождения в формат YYYY-MM-DD
const formattedDateOfBirth = computed(() => {
    if (birth_day.value && birth_month.value && birth_year.value) {
        return `${birth_year.value}-${String(birth_month.value).padStart(2, '0')}-${String(birth_day.value).padStart(2, '0')}`;
    }
    return '';
});

// Объединяем дату поступления в формат YYYY-MM-DD
const formattedDateOfAdmission = computed(() => {
    if (admission_day.value && admission_month.value && admission_year.value) {
        return `${admission_year.value}-${String(admission_month.value).padStart(2, '0')}-${String(admission_day.value).padStart(2, '0')}`;
    }
    return '';
});

const formFields = {
    address: { label: 'Полный адрес', type: 'text' },
    role: { label: 'Роль', type: 'text' },
    phone: { label: 'Введите телефон', type: 'tel' },
    email: { label: 'Email адрес', type: 'email' },
    password: { label: 'Пароль', type: 'password' },
    password_confirmation: { label: 'Подтвердите пароль', type: 'password' }
};

const months = [
    'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
    'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'
];

const birthYears = Array.from({ length: 125 }, (_, i) => new Date().getFullYear() - i);
const groups = ref([]);

// Загружаем список групп из БД
onMounted(async () => {
    try {
        const response = await axios.get('/api/groups');
        groups.value = response.data;
    } catch (error) {
        console.error('Ошибка загрузки групп:', error);
    }
});

const register = async () => {
    try {
        // Обновляем `date_of_birth` и `date_of_admission` перед отправкой
        form.value.date_of_birth = formattedDateOfBirth.value;
        form.value.date_of_admission = formattedDateOfAdmission.value;

        const response = await axios.post('/api/admin/user_create', form.value);
        localStorage.setItem("token", response.data.token);
        console.log("токен сохранён!");
        console.log('Успешная регистрация', response.data);
        window.location.href = "/all_users"
    } catch (error) {
        console.error('Ошибка регистрации', error.response?.data);
    }
};
</script>
