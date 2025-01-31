@extends('layouts.app')

@section('content')
    <div class="main-wrapper">
        <div class="col-md-7">
            <div class="row">
                <div class="card" style="margin-left: 250px">
                    <div class="card-body" >
                        <div class="post" id="news-post">
                            <!-- Новости будут загружаться сюда -->
                        </div>
                        <div id="comments-section">
                            <h4>Комментарии:</h4>
                            <div id="comments-list">
                                <!-- Комментарии будут загружаться сюда -->
                            </div>
                        </div>

                        <div class="post-header-actions">
                            <a href="#"><i class="fas fa-ellipsis-h"></i></a>
                            <button class="btn btn-danger btn-sm" id="delete-post">Удалить</button>
                            <a href="{{ url('/news/'.$id.'/edit') }}" class="btn btn-warning btn-sm">Редактировать</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const newsId = "{{ $id }}";  // Получаем ID новости из Blade шаблона
            const commentsList = document.getElementById('comments-list'); // Переменная для списка комментариев

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
                                <img src="{{ asset('storage/') }}/${data.image}" alt="Image" style="width: 100%" height="400px" object-fit="cover">
                                <p>${data.full_description}</p>
                            </div>

                            <div class="post-actions">
                                <ul class="list-unstyled">
                                    <li><a href="#" class="like-btn"><i class="far fa-heart"></i>Like</a></li>
                                    <li><a href="#"><i class="far fa-comment"></i>Comment</a></li>
                                    <li><a href="#"><i class="far fa-paper-plane"></i>Share</a></li>
                                </ul>
                            </div>

                            <div class="new-comment">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="comment-content" placeholder="Type something" aria-label="Type Something">
                                    <button class="btn btn-outline-secondary" id="comment-btn" type="button">Comment</button>
                                </div>
                            </div>
                        `;

                        // Загрузка и отображение комментариев
                        fetch(`{{ url('/api/comments') }}/${newsId}`)
                            .then(response => response.json())
                            .then(data => {
                                if (data && data.length > 0) {
                                    commentsList.innerHTML = data.map(comment => `
                                        <div class="comment" id="comment-${comment.id}">
                                            <p><strong>${comment.user.name}:</strong> ${comment.comment}</p>
                                            <small>${new Date(comment.created_at).toLocaleString()}</small>
                                            ${comment.user_id === {{ Auth::id() }} ? `
                                                <button class="btn btn-danger btn-sm" onclick="deleteComment(${comment.id})">Удалить</button>
                                            ` : ''}
                                        </div>
                                    `).join('');
                                } else {
                                    commentsList.innerHTML = '<p>Комментариев пока нет.</p>';
                                }
                            })
                            .catch(error => {
                                console.error("Ошибка загрузки комментариев:", error);
                                commentsList.innerHTML = "<p>Ошибка загрузки комментариев.</p>";
                            });

                    } else {
                        newsPost.innerHTML = "<p>Новость не найдена.</p>";
                    }

                })
                .catch(error => {
                    console.error("Ошибка загрузки новости:", error);
                    document.getElementById('news-post').innerHTML = "<p>Ошибка загрузки новости.</p>";
                });

            // Задержка перед поиском кнопки (для уверенности, что она появится)
            setTimeout(function () {
                const commentBtn = document.getElementById('comment-btn');
                if (commentBtn) {
                    commentBtn.addEventListener("click", function () {
                        const comment = document.getElementById('comment-content').value;
                        if (!comment) {
                            alert("Пожалуйста, введите комментарий!");
                            return;
                        }

                        console.log('Submitting comment:', comment);  // Проверим, что данные передаются

                        // Отправка POST-запроса для создания комментария
                        fetch(`{{ url('/api/comments') }}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Authorization': `Bearer ${localStorage.getItem('auth_token')}`,  // Токен аутентификации
                                'X-CSRF-TOKEN': "{{ csrf_token() }}" // Защита от CSRF
                            },
                            body: JSON.stringify({
                                comment: comment,
                                news_id: newsId  // Добавляем ID новости, к которой будет привязан комментарий
                            })
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.message) {
                                    alert(data.message);
                                } else {
                                    alert('Ошибка при добавлении комментария!');
                                }
                            })
                            .catch(error => {
                                console.error("Ошибка при добавлении комментария:", error);
                                alert('Ошибка при отправке комментария.');
                            });
                    });
                } else {
                    console.log('Comment button not found after delay');
                }
            }, 1000);  // Задержка в 1 секунду

            // Функция удаления комментария
            window.deleteComment = function(commentId) {
                if (!confirm('Вы уверены, что хотите удалить этот комментарий?')) {
                    return;
                }

                fetch(`{{ url('/api/comments') }}/${commentId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${localStorage.getItem('auth_token')}`, // Токен аутентификации
                        'X-CSRF-TOKEN': "{{ csrf_token() }}" // Защита от CSRF
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.message) {
                            alert(data.message);
                            if (data.message === 'Комментарий успешно удалён.') {
                                // Удаляем комментарий с фронта
                                document.getElementById(`comment-${commentId}`).remove();
                            }
                        } else {
                            alert('Ошибка при удалении комментария!');
                        }
                    })
                    .catch(error => {
                        console.error("Ошибка при удалении комментария:", error);
                        alert('Ошибка при удалении комментария.');
                    });
            }
        });
    </script>
@endsection
