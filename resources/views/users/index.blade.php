@extends('layouts.app')

@section('content')
    <div class="main-wrapper">
    <div class="container">
        <h2 class="mb-4 text-start">Список пользователей</h2>
        <div class="table-responsive shadow-lg p-3 bg-white rounded">
            <div class="mb-3" style="margin-left: 1090px">
                <a href="{{ route('admin.create.user') }}" class="btn btn-primary">Создать пользователя</a>
            </div>
            <table class="table table-hover text-center align-middle">
                <thead class="table-dark">
                <tr>
                    <th><input type="text" class="form-control filter-input" data-field="name" placeholder="Фильтр по имени"></th>
                    <th><input type="text" class="form-control filter-input" data-field="last_name" placeholder="Фильтр по фамилии"></th>
                    <th><input type="text" class="form-control filter-input" data-field="second_name" placeholder="Фильтр по отчеству"></th>
                    <th><input type="text" class="form-control filter-input" data-field="phone" placeholder="Фильтр по телефону"></th>
                    <th><input type="text" class="form-control filter-input" data-field="email" placeholder="Фильтр по email"></th>
                    <th><input type="text" class="form-control filter-input" data-field="date_of_admission" placeholder="ГГГГ-ММ-ДД"></th>
                    <th><input type="text" class="form-control filter-input" data-field="date_of_birth" placeholder="ГГГГ-ММ-ДД"></th>
                    <th><input type="text" class="form-control filter-input" data-field="address" placeholder="Фильтр по адресу"></th>
                    <th><input type="text" class="form-control filter-input" data-field="group_id" placeholder="Фильтр по группе"></th>
                    <th>
                        <select class="form-control filter-input" data-field="role">
                            <option value="">Все</option>
                            <option value="student">Студент</option>
                            <option value="teacher">Учитель</option>
                        </select>
                    </th>
                </tr>
                <tr>
                    <th>Имя</th>
                    <th>Фамилия</th>
                    <th>Отчество</th>
                    <th>Телефон</th>
                    <th>Эл. почта</th>
                    <th>Дата поступления</th>
                    <th>Дата рождения</th>
                    <th>Адрес</th>
                    <th>Группа</th>
                    <th>Роль</th>
                </tr>
                <!-- Строка фильтров -->

                </thead>
                <tbody id="users-table">
                <!-- Данные загружаются через JS -->
                </tbody>
            </table>
        </div>
    </div>


    <script>
        // Функция для получения фильтрованных данных
        async function fetchUsers() {
            // Собираем все поля фильтра
            const filters = {};
            document.querySelectorAll('.filter-input').forEach(input => {
                if(input.value.trim() !== '') {
                    filters[input.dataset.field] = input.value.trim();
                }
            });
            // Формируем query-параметры
            const queryParams = new URLSearchParams(filters).toString();
            const url = `http://127.0.0.1:8000/api/users${queryParams ? '?' + queryParams : ''}`;

            try {
                const response = await fetch(url);
                const data = await response.json();
                if(!Array.isArray(data.data)) throw new Error("Данные не являются массивом");
                renderTable(data.data);
            } catch (error) {
                console.error("Ошибка загрузки данных: ", error);
            }
        }

        // Функция для отрисовки таблицы
        function renderTable(users) {
            let tableBody = document.getElementById("users-table");
            tableBody.innerHTML = "";
            users.forEach(user => {
                let row = `<tr class="table-light">
                    <td>${user.name}</td>
                    <td>${user.last_name}</td>
                    <td>${user.second_name}</td>
                    <td>${user.phone}</td>
                    <td>${user.email}</td>
                    <td>${user.date_of_admission}</td>
                    <td>${user.date_of_birth}</td>
                    <td>${user.address ?? '—'}</td>
                    <td>${user.group_id}</td>
                    <td><span class="badge bg-${user.role === 'student' ? 'primary' : 'success'}">${user.role}</span></td>
                </tr>`;
                tableBody.innerHTML += row;
            });
        }

        // При загрузке страницы получаем всех пользователей
        document.addEventListener("DOMContentLoaded", function () {
            fetchUsers();
        });

        // Добавляем обработчики на изменения фильтров
        document.querySelectorAll('.filter-input').forEach(input => {
            input.addEventListener('input', function () {
                // Можно добавить задержку (debounce) для уменьшения количества запросов
                fetchUsers();
            });
        });
    </script>

    <style>
        .table-responsive {
            border-radius: 10px;
            overflow: hidden;
        }
        table {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px;
            text-align: center;
        }
        .badge {
            font-size: 14px;
            padding: 5px 10px;
        }
        /* Стили для input-фильтров */
        .filter-input {
            width: 100%;
            padding: 4px;
            box-sizing: border-box;
        }
    </style>
@endsection
