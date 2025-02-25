@extends('layouts.app')
@section('content')
    <div class="main-wrapper">
        <div class="container">
            <h2 class="mb-4 text-start">Список преподователей</h2>
            <div class="table-responsive shadow-lg p-3 bg-white rounded">
                <table class="table table-hover text-center align-middle">
                    <thead class="table-dark">
                    <tr>
                        <th>Имя</th>
                        <th>Фамилия</th>
                        <th>Отчество</th>
                        <th>Телефон</th>
                        <th>Эл. почта</th>
                        <th>Дата поступления</th>
                        <th>Дата рождения</th>
                        <th>Адрес</th>
                        <th>Роль</th>
                    </tr>
                    </thead>
                    <tbody id="teachers-table">
                    <!-- Данные загружаются через JS -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            fetch("http://127.0.0.1:8000/api/teachers")
                .then(response => response.json())
                .then(data => {
                    let users = data.data;
                    if (!Array.isArray(users)) throw new Error("Данные не являются массивом");

                    let tableBody = document.getElementById("teachers-table");
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
                            <td>${user.role ?? '—'}</td>
                        </tr>`;
                        tableBody.innerHTML += row;
                    });
                })
                .catch(error => console.error("Ошибка загрузки данных: ", error));
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
    </style>
@endsection
