<?php

use App\Http\Controllers\AdminController;
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

Route::get('/all_users', [\App\Http\Controllers\UserController::class, 'index'])->middleware(['auth', 'admin']);
Route::get('/teachers', [\App\Http\Controllers\UserController::class, 'getTeachers']);

Route::get('/documents/create', [\App\Http\Controllers\DocumentController::class, 'index']);
Route::get('/documents', [\App\Http\Controllers\DocumentController::class, 'getDocuments']);

Route::get('/admin/create/user', [AdminController::class, 'create'])->name('admin.create.user');
