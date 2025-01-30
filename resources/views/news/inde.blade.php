@extends('layouts.app')
@section('content')
    <div class="main-wrapper">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
            text-align: left;
        }

        h2 {
            color: #333;
        }

        #news-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .news-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            padding: 15px;
            text-align: left;
            transition: transform 0.2s;
        }

        .news-card:hover {
            transform: scale(1.05);
        }

        .news-title {
            font-size: 18px;
            font-weight: bold;
            color: #2db1b1;
        }

        .news-content {
            font-size: 14px;
            margin-top: 10px;
        }
        .news-card img {
            width: 100%;           /* Ширина картинки будет равна ширине карточки */
            height: 200px;         /* Фиксированная высота для изображения */
            object-fit: cover;     /* Обеспечивает сохранение пропорций и заполнение области */
            border-radius: 8px;    /* Радиус для округления углов изображения */
            margin-bottom: 10px;
        }  /* Отступ снизу для картинки */
    </style>
<h2>Новости</h2>

<div id="news-container">
    <p>Загрузка...</p>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        fetch("{{ url('/api/news') }}")
            .then(response => response.json())
            .then(data => {
                let container = document.getElementById("news-container");
                container.innerHTML = ""; // Очищаем контейнер

                if (data.length === 0) {
                    container.innerHTML = "<p>Новостей пока нет</p>";
                    return;
                }

                data.forEach(news => {
                    let card = document.createElement("div");
                    card.className = "news-card";
                    card.innerHTML = `
                            <div class="news-title">${news.title}</div>
                            <img src="{{ asset('storage') }}/${news.image}" alt="Image" class="news-card img">
                            <div class="news-content">${news.short_description}</div>
                            <a href="{{ url('/news') }}/${news.id}" class="btn-show">Подробнее</a>
                        `;
                    container.appendChild(card);
                });
            })
            .catch(error => console.error("Ошибка загрузки новостей:", error));
    });
</script>
</div>
    @endsection
