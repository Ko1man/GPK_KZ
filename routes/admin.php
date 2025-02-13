<?php

use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/news', [NewsController::class, 'index']);
Route::get('/news/{id}', [NewsController::class, 'show']);
Route::get('/create', [NewsController::class, 'create']);
Route::get('/news/{id}/edit', [NewsController::class, 'edit']);



Route::get('/register', [\App\Http\Controllers\AuthController::class, 'index']);
Route::get('/login', [\App\Http\Controllers\AuthController::class, 'showLogin']);
