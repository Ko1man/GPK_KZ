<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\updateUserRequest;
use App\Models\User;

class UserController extends Controller
{
    public function getAllUsers(){
        return response()->json(['message'=>'Список пользовотелей выведен успешно', 'data'=>User::all()],200);
    }

    public function getUser($id){
        $user = User::findOrFail($id);
        return response()->json([
            'status'=>true,
            'massage'=>'пользователь выведен успешно',
            'user' => $user,
        ]);
    }

    public function updateUser(updateUserRequest $request, User $user){
        $user->update($request->validated());
        return response()->json(['massage'=>'пользователь обновлен успешно','data'=>$user],200);
    }

    public function getTeachers(){
        $teachers = User::where('role', 'teacher')->get();
        return response()->json(['success'=> true, 'data'=>$teachers], 200);
    }

    public function getStudents(){
        $students=User::where('role', 'student')->get();
        return response()->json(['success'=> true, 'data'=>$students], 200);
    }





}
