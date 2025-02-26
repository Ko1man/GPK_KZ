@extends('layouts.app')

@section('content')
    <div class="main-wrapper">
    <div class="container mt-5">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between" style="width: 100%;">
                <h2 class="flex-grow-1" style="white-space: nowrap;">Список загруженных документов</h2>
                <a href="{{route('documents.create')}}" class="btn btn-primary mb-3">Загрузить документ</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Название</th>
                            <th>Отдел</th>
                            <th>Дата загрузки</th>
                            <th>Документ</th>
                        </tr>
                        </thead>
                        <tbody id="documents-table">
                        <tr>
                            <td colspan="5" class="text-center text-muted py-3">🔄 Загрузка данных...</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            fetch("{{ url('/api/documents') }}")
                .then(response => response.json())
                .then(data => {
                    const tableBody = document.getElementById("documents-table");
                    tableBody.innerHTML = "";

                    if (data.length === 0) {
                        tableBody.innerHTML = "<tr><td colspan='5' class='text-center text-muted py-3'>📭 Документы не найдены.</td></tr>";
                        return;
                    }

                    data.forEach((doc, index) => {
                        const fileUrl = `/storage/${doc.file}`; // путь к файлу в `storage/app/public`

                        const row = `
                            <tr class="border-bottom">
                                <td class="fw-bold">${index + 1}</td>
                                <td>${doc.title}</td>
                                <td>${doc.department}</td>
                                <td>${new Date(doc.created_at).toLocaleString()}</td>
                                <td>
                                    <a href="${fileUrl}" class="btn btn-sm btn-outline-primary shadow-sm" target="_blank">
                                        📥 Скачать
                                    </a>
                                </td>
                            </tr>
                        `;

                        tableBody.innerHTML += row;
                    });
                })
                .catch(error => {
                    console.error("Ошибка загрузки данных:", error);
                    document.getElementById("documents-table").innerHTML =
                        "<tr><td colspan='5' class='text-center text-danger py-3'>❌ Ошибка загрузки данных.</td></tr>";
                });
        });
    </script>
@endsection
