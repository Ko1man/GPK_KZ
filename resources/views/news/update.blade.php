@extends('layouts.app')

@section('content')
    <div class="main-wrapper">
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <h2>Редактировать новость</h2>
                    <form id="news-form">
                        <input type="hidden" id="news_id" value="{{ $news->id }}">  <!-- ID новости для обновления -->
                        <div class="form-group">
                            <label for="title">Заголовок</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ $news->title }}" required>
                        </div>
                        <div class="form-group">
                            <label for="short_description">Краткое описание</label>
                            <textarea class="form-control" id="short_description" name="short_description" required>{{ $news->short_description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="full_description">Полное описание</label>
                            <textarea class="form-control" id="full_description" name="full_description" required>{{ $news->full_description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Изображение</label>
                            <input type="file" class="form-control" id="image" name="image">
                            <p>Текущее изображение: <img src="{{ asset('storage/'.$news->image) }}" width="100" height="100" alt="Image"></p>
                        </div>
                        <div class="form-group">
                            <label for="author_id">Автор</label>
                            <select class="form-control" id="author_id" name="author_id" required>
                                <!-- Здесь будут отображаться авторы -->
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Обновить новость</button>
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
                formData.append("_method", "PUT");  // Указываем метод PUT для обновления
                formData.append("title", document.getElementById("title").value);
                formData.append("short_description", document.getElementById("short_description").value);
                formData.append("full_description", document.getElementById("full_description").value);
                formData.append("image", document.getElementById("image").files[0]);
                formData.append("author_id", document.getElementById("author_id").value);

                const news = document.getElementById("news_id").value;

                // Отправка данных через fetch
                fetch("{{ url('/api/news') }}/" + news, {
                    method: "PUT",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",  // Для защиты от CSRF атак
                    },
                    body: formData,
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert("Новость успешно обновлена!");
                            window.location.href = "{{ url('/news') }}";
                        } else {
                            alert("Ошибка при обновлении новости.");
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
