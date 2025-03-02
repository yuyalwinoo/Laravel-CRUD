<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::middleware('auth:sanctum')->group(function () {
//     Route::apiResource('posts', PostController::class); 
//     Route::get('api/posts/create', [PostController::class, 'create'])->name('posts.create');
//     Route::get('posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');

//     Route::apiResource('users', UserController::class); 
//     Route::get('api/users/create', [UserController::class, 'create'])->name('users.create');
//     Route::get('users/{post}/edit', [UserController::class, 'edit'])->name('users.edit');
// });

// Route::get('api/users/login-index', [UserController::class, 'loginIndex'])->name('users.login-index');
// Route::post('api/users/login', [UserController::class, 'login'])->name('users.login');
Route::apiResource('posts', PostController::class); 
Route::get('api/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::get('api/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
