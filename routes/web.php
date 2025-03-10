<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
