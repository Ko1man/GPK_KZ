@extends('layouts.app')

@section('content')
    <div class="main-wrapper">
        <div class="col-md-7 d-flex justify-content-center">
            <div class="row">
        <div class="card" style="width: 100%; max-width: 700px;">
            <div class="card-body">
                <div class="post" id="news-post">
                    <!-- Новости будут загружаться сюда -->
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>



    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const newsId = "{{ $id }}";  // Получаем ID новости из Blade шаблона

            // Функция для загрузки новости через API
            fetch(`{{ url('/api/news') }}/${newsId}`)
                .then(response => response.json())
                .then(data => {
                    const newsPost = document.getElementById('news-post');

                    if (data) {
                        // Загружаем данные новости в шаблон
                        newsPost.innerHTML = `
                            <div class="post-header">

                                <div class="post-info">
                                    <span class="post-author">${data.author.name}</span><br>
                                    <img src="{{ asset('storage/') }}/${data.author.profile_image}" alt="Image">
                                    <span class="post-date">${new Date(data.created_at).toLocaleString()}</span>
                                </div>
                                <div class="post-header-actions">
                                    <a href="#"><i class="fas fa-ellipsis-h"></i></a>
                                </div>
                            </div>

                            <div class="post-body">
                                <h2>${data.title}</h2>
                             <img src="{{ asset('storage/') }}/${data.image}" alt="Image" style="width: 100%" height="400 px" object-fit: cover;>
                                <p>${data.full_description}</p>
                            </div>

                            <div class="post-actions">
                                <ul class="list-unstyled">
                                    <li><a href="#" class="like-btn"><i class="far fa-heart"></i>Like</a></li>
                                    <li><a href="#"><i class="far fa-comment"></i>Comment</a></li>
                                    <li><a href="#"><i class="far fa-paper-plane"></i>Share</a></li>
                                </ul>
                            </div>

                            {{--<div class="post-comments">--}}
                            {{--    ${data.comments.map(comment => `--}}
                            {{--        <div class="post-comm">--}}
                            {{--            <img src="{{ asset('storage/') }}/${comment.user.profile_image}" class="comment-img" alt="">--}}
                            {{--            <div class="comment-container">--}}
                            {{--                <span class="comment-author">--}}
                            {{--                    ${comment.user.name}--}}
                            {{--                    <small class="comment-date">${new Date(comment.created_at).toLocaleString()}</small>--}}
                            {{--                </span>--}}
                            {{--            </div>--}}
                            {{--            <span class="comment-text">--}}
                            {{--                ${comment.text}--}}
                            {{--            </span>--}}
                            {{--        </div>--}}
                            {{--    `).join('')}--}}
                            {{--</div>--}}

                            <div class="new-comment">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Type something" aria-label="Type Something">
                                    <button class="btn btn-outline-secondary" type="button">Comment</button>
                                </div>
                            </div>
                        `;
                    } else {
                        newsPost.innerHTML = "<p>Новость не найдена.</p>";
                    }
                })
                .catch(error => {
                    console.error("Ошибка загрузки новости:", error);
                    document.getElementById('news-post').innerHTML = "<p>Ошибка загрузки новости.</p>";
                });
        });
    </script>
@endsection


