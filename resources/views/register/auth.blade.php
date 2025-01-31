@extends('layouts.auth')
@section('content')
    <div class="row">
        <div class="col-md-5" style="margin-left: 450px">
            <div class="card">
                <div class="card-body">
                    <div class="authent-logo">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRZKI4TQbK_XyVGN1uKh1axEytNq6iWqOSFXQ&s" style="height: 100px" width="100px" alt="">
                    </div>
                    <div class="authent-text">
                        <p>
                            Добро пожаловать на GPK.kz
                        </p>
                        <p>Введите данные для входа в аккаунт</p>
                    </div>

                    <form id="login-form">
                        <div class="mb-3">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="email" placeholder="name@example.com" required>
                                <label for="email">Email адрес</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-floating">
                                <input type="password" class="form-control" id="password" placeholder="Password" required>
                                <label for="password">Пароль</label>
                            </div>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary m-b-xs">Войти</button>
                        </div>
                    </form>

                    <div class="authent-register">
                        <p>Нет аккаунта? <a href="register.html">Зарегистрироваться</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('login-form').addEventListener('submit', function(e) {
            e.preventDefault(); // Предотвращаем стандартное поведение формы

            // Получаем данные из формы
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Отправляем данные на сервер через API
            fetch('/api/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    email: email,
                    password: password
                })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.token) {
                        // Сохраняем токен в localStorage (или sessionStorage, cookies)
                        localStorage.setItem('auth_token', data.token);
                        alert('Login successful!');
                        // Перенаправляем на главную страницу
                        window.location.href = '/news';
                    } else {
                        alert('Login failed: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Login error!');
                });
        });
    </script>
@endsection

