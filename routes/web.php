<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('posts.index');
});

// Route::get('posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
