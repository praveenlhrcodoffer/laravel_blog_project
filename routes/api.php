<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;



Route::group(['prefix' => '/auth'], function () {

    Route::post('/login', [AuthController::class, 'loginUser'])->name('auth.login');
    Route::post('/register', [AuthController::class, 'registerUser'])->name('auth.register');
    // Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/logout', [AuthController::class, 'logoutUser'])->name('auth.logout');
    //     Route::get('/user', [AuthController::class, 'user']);
    // });
});
