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

Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show');
Route::get('/create', [NewsController::class, 'create'])->name('news.create');
Route::get('/news/{id}/edit', [NewsController::class, 'edit'])->name('news.edit');



Route::get('/register', [\App\Http\Controllers\AuthController::class, 'index'])->name('register');
Route::get('/login', [\App\Http\Controllers\AuthController::class, 'showLogin'])->name('login');

Route::get('/all_users', [\App\Http\Controllers\UserController::class, 'index'])->middleware(['auth', 'admin'])->name('all_users');
Route::get('/teachers', [\App\Http\Controllers\UserController::class, 'getTeachers'])->name('getTeachers');
Route::get('/students', [\App\Http\Controllers\UserController::class, 'getStudents'])->name('getStudents');

Route::get('/documents/create', [\App\Http\Controllers\DocumentController::class, 'index'])->name('documents.create');
Route::get('/documents', [\App\Http\Controllers\DocumentController::class, 'getDocuments'])->name('documents');

Route::get('/admin/create/user', [AdminController::class, 'create'])->name('admin.create.user');
