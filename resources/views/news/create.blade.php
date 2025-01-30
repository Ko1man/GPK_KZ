@extends('layouts.app')

@section('content')
    <div class="main-wrapper">
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <h2>Создать новость</h2>
                    <form id="news-form">
                        <div class="form-group">
                            <label for="title">Заголовок</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="short_description">Краткое описание</label>
                            <textarea class="form-control" id="short_description" name="short_description" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="full_description">Полное описание</label>
                            <textarea class="form-control" id="full_description" name="full_description" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Изображение</label>
                            <input type="file" class="form-control" id="image" name="image" required>
                        </div>
                        <div class="form-group">
                            <label for="author_id">Автор</label>
                            <select class="form-control" id="author_id" name="author_id" required>
                                <option value="">выберите автора</option>
                                <!-- Здесь будут отображаться авторы -->
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Создать новость</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Загрузка авторов для выпадающего списка
            fetch("{{ url('/api/authors') }}")
                .then(response => response.json())
                .then(data => {
                    const authorSelect = document.getElementById("author_id");
                    data.forEach(author => {
                        const option = document.createElement("option");
                        option.value = author.id;
                        option.textContent = author.name;
                        authorSelect.appendChild(option);
                    });
                })
                .catch(error => console.error("Ошибка загрузки авторов:", error));

            // Отправка формы
            document.getElementById("news-form").addEventListener("submit", function (event) {
                event.preventDefault();  // Предотвращаем стандартное поведение формы

                const formData = new FormData();
                formData.append("title", document.getElementById("title").value);
                formData.append("short_description", document.getElementById("short_description").value);
                formData.append("full_description", document.getElementById("full_description").value);
                formData.append("image", document.getElementById("image").files[0]);
                formData.append("author_id", document.getElementById("author_id").value);

                // Отправка данных через fetch
                fetch("{{ url('/api/news/create') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",  // Для защиты от CSRF атак
                    },
                    body: formData,
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert("Новость успешно создана!");
                            document.getElementById("news-form").reset();
                            window.location.href = "{{ url('/news') }}";
                        } else {
                            alert("Ошибка при создании новости.");
                        }
                    })
                    .catch(error => {
                        console.error("Ошибка при отправке формы:", error);
                        alert("Произошла ошибка.");
                    });
            });
        });
    </script>
@endsection

