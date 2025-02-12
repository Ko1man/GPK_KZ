@extends('layouts.auth')
@section('content')
    <div class="row">
        <div class="col-md-5 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="authent-logo text-center">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRZKI4TQbK_XyVGN1uKh1axEytNq6iWqOSFXQ&s"
                             style="height: 100px; width: 100px;"
                             alt="Логотип">
                    </div>
                    <div class="authent-text text-center">
                        <p>Добро пожаловать на GPK.kz</p>
                        <p>Введите данные для создания аккаунта</p>
                    </div>

                    <form id="register-form">
                        @csrf
                        <div class="mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="fullname" name="name" placeholder="Имя" required>
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

                        <!-- Дата рождения -->
                        <div class="form-group mb-3">
                            <label for="birth_day">Дата рождения</label>
                            <div class="d-flex">
                                <select class="form-control me-2" id="birth_day" required>
                                    <option value="">День</option>
                                    @for ($day = 1; $day <= 31; $day++)
                                        <option value="{{ $day }}">{{ $day }}</option>
                                    @endfor
                                </select>
                                <select class="form-control me-2" id="birth_month" required>
                                    <option value="">Месяц</option>
                                    @foreach (["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"] as $key => $month)
                                        <option value="{{ $key + 1 }}">{{ $month }}</option>
                                    @endforeach
                                </select>
                                <select class="form-control" id="birth_year" required>
                                    <option value="">Год</option>
                                    @for ($year = now()->year; $year >= 1900; $year--)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <!-- Дата поступления -->
                        <div class="form-group mb-3">
                            <label for="day_of_admission">Дата поступления</label>
                            <div class="d-flex">
                                <select class="form-control me-2" id="day_of_admission" required>
                                    <option value="">День</option>
                                    @for ($day = 1; $day <= 31; $day++)
                                        <option value="{{ $day }}">{{ $day }}</option>
                                    @endfor
                                </select>
                                <select class="form-control me-2" id="month_of_admission" required>
                                    <option value="">Месяц</option>
                                    @foreach (["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"] as $key => $month)
                                        <option value="{{ $key + 1 }}">{{ $month }}</option>
                                    @endforeach
                                </select>
                                <select class="form-control" id="year_of_admission" required>
                                    <option value="">Год</option>
                                    @for ($year = now()->year; $year >= 1900; $year--)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="group" name="group_id" placeholder="Введите номер группы" required>
                                <label for="group">Группа</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-floating">
                                <input type="tel" class="form-control" id="phone" name="phone" placeholder="Введите телефон" required>
                                <label for="phone">Введите телефон</label>
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
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
                            <input type="hidden" id="register-url" value="{{ route('register') }}">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('register-form').addEventListener('submit', async function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const registerUrl = document.getElementById('register-url').value;

            // Формируем дату рождения
            const dateOfBirth = `${document.getElementById('birth_year').value}-${document.getElementById('birth_month').value.padStart(2, '0')}-${document.getElementById('birth_day').value.padStart(2, '0')}`;

            // Формируем дату поступления
            const dateOfAdmission = `${document.getElementById('year_of_admission').value}-${document.getElementById('month_of_admission').value.padStart(2, '0')}-${document.getElementById('day_of_admission').value.padStart(2, '0')}`;

            const dataToSend = Object.fromEntries(formData.entries());
            dataToSend.date_of_birth = dateOfBirth;
            dataToSend.date_of_admission = dateOfAdmission;

            try {
                const response = await fetch(registerUrl, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(dataToSend)
                });

                const data = await response.json();
                if (response.ok) {
                    alert('Регистрация успешна!');
                    window.location.href = '/news';
                } else {
                    alert('Ошибка: ' + (data.message || 'Попробуйте снова'));
                }
            } catch (error) {
                alert('Ошибка при отправке данных');
            }
        });
    </script>
@endsection
