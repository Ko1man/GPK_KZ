@extends('layouts.auth')
@section('content')
    <div class="row">
        <div class="col-md-5 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="authent-logo text-center">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRZKI4TQbK_XyVGN1uKh1axEytNq6iWqOSFXQ&s"
                             style="height: 100px; width: 100px;"
                             alt="">
                    </div>
                    <div class="authent-text text-center">
                        <p>Добро пожаловать на GPK.kz</p>
                        <p>Введите данные для создания аккаунта</p>
                    </div>

                    <form id="register-form">
                        @csrf
                        <div class="mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Имя" required>
                                <label for="fullname">Имя</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="second_name" name="second_name" placeholder="Фамилия" required>
                                <label for="second_name">Фамилия</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Отчество" required>
                                <label for="last_name">Отчество</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="address" name="address" placeholder="Полный адрес" required>
                                <label for="address">Полный адрес</label>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="birth_day">Дата рождения</label>
                            <div class="d-flex">
                                <select class="form-control me-2" id="birth_day" name="birth_day" required>
                                    <option value="">День</option>
                                    @for ($day = 1; $day <= 31; $day++)
                                        <option value="{{ $day }}">{{ $day }}</option>
                                    @endfor
                                </select>
                                <select class="form-control me-2" id="birth_month" name="birth_month" required>
                                    <option value="">Месяц</option>
                                    @foreach (["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"] as $key => $month)
                                        <option value="{{ $key + 1 }}">{{ $month }}</option>
                                    @endforeach
                                </select>
                                <select class="form-control" id="birth_year" name="birth_year" required>
                                    <option value="">Год</option>
                                    @for ($year = now()->year; $year >= 1900; $year--)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
                                <label for="email">Email адрес</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-floating">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Пароль" required>
                                <label for="password">Пароль</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-floating">
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Подтвердите пароль" required>
                                <label for="password_confirmation">Подтвердите пароль</label>
                            </div>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="terms" required>
                            <label class="form-check-label" for="terms">Я даю разрешение на хранение и использование личной информации</label>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('register-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            fetch('{{ route("register") }}', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') },
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Регистрация успешна!');
                        window.location.href = '/news';
                    } else {
                        alert('Ошибка: ' + (data.message || 'Попробуйте снова'));
                    }
                })
                .catch(error => alert('Ошибка при отправке данных'));
        });
    </script>
@endsection
