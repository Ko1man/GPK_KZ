@extends('layouts.app')

@section('content')
    <div class="main-wrapper">
        <div class="row">
            <div class="col-md-3">
                <div class="card" id="news-container">
                    <!-- Новости будут загружены сюда -->
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", async function () {
            try {
                let response = await fetch('http://127.0.0.1:8000/api/news');
                let news = await response.json(); // API уже возвращает массив, не нужен data.data

                if (!Array.isArray(news)) throw new Error("Данные не являются массивом");

                let newsContainer = document.getElementById("news-container");
                newsContainer.innerHTML = ""; // Очищаем контейнер перед добавлением

                news.forEach(news1 => {
                    let newsCard = `
                <div class="card mb-3">
                    <img src="/storage/${news1.image}" class="card-img-top" alt="News Image">
                    <div class="card-body">
                        <h5 class="card-title">${news1.title}</h5>
                        <p class="card-text">${news1.short_description}</p>
                        <a href="/news/${news1.id}" class="btn btn-primary">Читать далее</a>
                    </div>
                </div>
            `;
                    newsContainer.innerHTML += newsCard;
                });
            } catch (error) {
                console.error("Ошибка загрузки новостей:", error);
            }
        });

    </script>
@endsection
