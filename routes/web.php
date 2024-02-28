<?php

use App\Models\Listing;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use  App\Http\Controllers\AuthController;
use  App\Http\Controllers\LoginController;
use App\Http\Controllers\Api\UserController;


Route::get('/', [BlogController::class, 'index'])->name('posts.home');
Route::get('/search', [BlogController::class, 'searchPost'])->name('posts.search');
Route::get('/posts/{id}', [BlogController::class, 'showDetailPost'])->name('posts.detail');


Route::prefix('user')->group(function () {
    Route::get('/login', [BlogController::class, 'showLoginPage'])->name('user.login');
    Route::get('/register', [BlogController::class, 'showRegisterPage'])->name('user.register');
});

Route::middleware('auth')->group(function () {
    Route::get('/post/add', [BlogController::class, 'showAddPostPage'])->name('post.showAdd');
    Route::post('/post/add', [BlogController::class, 'addPostToDb'])->name('post.add');
});


Route::delete('/post/delete/{id}', [BlogController::class, 'deletePostFromDb'])->name('post.delete');
