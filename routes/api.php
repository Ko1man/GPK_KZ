<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\ComentController;
use App\Http\Controllers\Api\NewsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/authors', [AuthorController::class, 'index']);

Route::get('/news', [NewsController::class, 'index']);
Route::post('/news/create', [NewsController::class, 'store']);
Route::get('/news/{news}', [NewsController::class, 'show']);
Route::put('/news/{news}', [NewsController::class, 'update']);
Route::delete('/news/{news}', [NewsController::class, 'destroy']);

Route::post('/comments', [ComentController::class, 'store']);
Route::get('/comments/{newsId}', [ComentController::class, 'getComments']);
Route::delete('/comments/{commentId}', [ComentController::class, 'delete']);


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
