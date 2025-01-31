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
            <p>Введите данные для создания аккаунта</p>
        </div>

        <form id="register-form">
            <div class="mb-3">
                <div class="form-floating">
                    <input type="text" class="form-control" id="fullname" placeholder="Fullname" required>
                    <label for="fullname">Польное имя</label>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-floating">
                    <input type="email" class="form-control" id="email" placeholder="name@example.com" required>
                    <label for="email">Email адрес</label>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-floating">
                    <input type="tel" class="form-control" id="phone" placeholder="phone" required>
                    <label for="phone">Ваш Телефон</label>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-floating">
                    <input type="password" class="form-control" id="password" placeholder="Password" required>
                    <label for="password">Пароль</label>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-floating">
                    <input type="password" class="form-control" id="password_confirmation" placeholder="Confirm Password" required>
                    <label for="password_confirmation">Поддвердите пароль</label>
                </div>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="terms" required>
                <label class="form-check-label" for="terms">Я даю разрешение на хранение и использование личной информации</label>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary m-b-xs">Зарегестрироваться</button>
            </div>
        </form>

        <div class="authent-login">
            <p>Already have an account? <a href="login.html">Sign in</a></p>
        </div>
        </div>
    </div>
</div>
</div>

<script>
    document.getElementById('register-form').addEventListener('submit', function(e) {
        e.preventDefault(); // Предотвращаем стандартное поведение формы

        // Получаем данные из формы
        const fullname = document.getElementById('fullname').value;
        const email = document.getElementById('email').value;
        const phone = document.getElementById('phone').value;
        const password = document.getElementById('password').value;
        const password_confirmation = document.getElementById('password_confirmation').value;

        // Проверка, чтобы пароли совпадали
        if (password !== password_confirmation) {
            alert('Passwords do not match!');
            return;
        }
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Отправляем данные на сервер через API
        fetch('/api/register', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                name: fullname,
                email: email,
                phone: phone,
                password: password,
                password_confirmation: password_confirmation
            })
        })
            .then(response => response.json())
            .then(data => {
                if (data.token) {
                    // Сохраняем токен в localStorage (или sessionStorage, cookies)
                    localStorage.setItem('auth_token', data.token);
                    alert('Registration successful!');
                    // Перенаправляем на страницу логина или главную
                    window.location.href = '/news';
                } else {
                    alert('Registration failed: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Registration error!');
            });
    });
</script>
@endsection

