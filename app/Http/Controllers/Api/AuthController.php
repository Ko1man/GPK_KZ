<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;

class AuthController extends Controller
{


    /**
     * Store a newly created resource in storage.
     */
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name'=> $request->name,
            'last_name'=> $request->last_name,
            'second_name' => $request->second_name,
            'date_of_admission' => $request->date_of_admission,
            'date_of_birth' => $request->date_of_birth,
            'group_id' => $request->group_id,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => Hash::make($request->password),

        ]);
        $token = $user->createToken('auth_token')->plainTextToken;

        Auth::login($user);

        return response()->json([
            'message' => 'Регистрация прошла успешно!',
            'user'    => $user,
            'token'   => $token,
        ], 201);
    }




    /**
     * Логин пользователя.
     */
    public function login(loginRequest $request)
    {
        // Валидация данных запроса
        $validated = $request->validated();

        // Проверка, существует ли пользователь с данным email
        $user = User::where('email', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            // Если пользователь не найден или пароль неверный
            return response()->json([
                'message' => 'Неверные учетные данные!',
            ], 401); // Код 401 — Unauthorized
        }

        // Создание токена (если используется Laravel Sanctum)
        $token = $user->createToken('auth_token')->plainTextToken;

        // Логиним пользователя
        Auth::login($user);

        // Возвращаем ответ с токеном
        return response()->json([
            'message' => 'Успешный вход в систему!',
            'token' => $token,  // Токен для аутентификации в дальнейшем
        ], 200); // Код 200 — OK
    }


}
