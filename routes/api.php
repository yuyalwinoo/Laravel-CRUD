<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



// Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('posts', PostController::class); 
    Route::get('api/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::get('api/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
// });

Route::apiResource('users', UserController::class); 
Route::get('api/users/create', [UserController::class, 'create'])->name('users.create');
Route::get('users/{post}/edit', [UserController::class, 'edit'])->name('users.edit');

Route::prefix('auth')->group(function () {
    Route::prefix('login')->group(function () {
        Route::get('/', [AuthController::class, 'index'])->name('auth.login');
        Route::post('/', [AuthController::class, 'login'])->name('login');
    });
     Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');
     });
});