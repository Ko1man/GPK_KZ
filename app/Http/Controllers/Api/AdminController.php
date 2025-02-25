<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function store(RegisterRequest $request){
        $user = User::create([
            'name'=> $request->name,
            'last_name'=> $request->last_name,
            'second_name' => $request->second_name,
            'date_of_admission' => $request->date_of_admission,
            'date_of_birth' => $request->date_of_birth,
            'group_id' => $request->group_id,
            'email'    => $request->email,
            'address'    => $request->address,
            'phone'    => $request->phone,
            'password' => Hash::make($request->password),
            'role'=>$request->role
        ]);
        $token = $user->createToken('MyApp')->plainTextToken;

        return response()->json([
            'success'=>true,
            'token' => $token,
            'data'=>$user
        ],201);
    }
}
