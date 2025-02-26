@extends('layouts.app')

@section('content')
    <div class="main-wrapper">
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <h2>Создать новость</h2>
                    <form id="news-form">
                        <div class="form-group">
                            <label for="title">Название</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="file">Выберите документ</label>
                            <input type="file" class="form-control" id="file" name="file" required>
                        </div>
                        <div class="form-group">
                            <label for="department">Автор</label>
                            <select class="form-control" id="department" name="department" required>
                                <option>выберите отдел</option>
                                <option>Отдел кадров</option>
                                <option>Бухгалтерия</option>
                                <option>Студ. Совет</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Создать новость</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("news-form").addEventListener("submit", function (event) {
            event.preventDefault(); // Предотвращаем стандартное поведение формы

            const title = document.getElementById("title").value.trim();
            const file = document.getElementById("file").files[0];
            const department = document.getElementById("department").value;

            if (!title || !file || !department) {
                alert("Все поля обязательны!");
                return;
            }

            const formData = new FormData();
            formData.append("title", title);
            formData.append("file", file);
            formData.append("department", department);
            formData.append("_token", "{{ csrf_token() }}");

            fetch("{{ url('/api/add_document') }}", {
                method: "POST",
                body: formData,
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Документ успешно загружен!");
                        document.getElementById("news-form").reset();
                        window.location.replace("{{ url('/documents') }}");
                    } else {
                        alert("ошибка при загрузке документа: " + (data.message || "Неизвестная ошибка"));
                    }
                })
                .catch(error => {
                    console.error("Ошибка при отправке формы:", error);
                    alert("Произошла ошибка.");
                });
        });
    </script>

@endsection
