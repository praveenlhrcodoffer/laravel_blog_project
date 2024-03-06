<?php

use App\Models\Listing;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use  App\Http\Controllers\AuthController;
use  App\Http\Controllers\LoginController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;

//|> Routes for views
Route::get('/', [BlogController::class, 'index'])->name('posts.home');
Route::get('/search', [BlogController::class, 'searchPost'])->name('posts.search');
Route::get('/posts/{id}', [BlogController::class, 'showDetailPost'])->name('posts.detail');


Route::prefix('user')->group(function () {
    Route::get('/login', [BlogController::class, 'showLoginPage'])->name('user.login');
    Route::get('/register', [BlogController::class, 'showRegisterPage'])->name('user.register');
});


//|> Routes for post CRUD
Route::middleware(['auth:web'])->group(function () {
    Route::get('/post/add', [BlogController::class, 'showPostCreatePage'])->name('post.createPage');
    Route::post('/post/add', [BlogController::class, 'addPostToDb'])->name('post.create');
    Route::put('/post/update/{id}', [BlogController::class, 'updatePost'])->name('post.update');
});

// OR -> different syntax
// Route::controller(BlogController::class)->middleware(['auth:web'])->group(function () {
//     Route::get('/post/add', 'showPostCreatePage')->name('post.createPage');
//     Route::post('/post/add', 'addPostToDb')->name('post.create');
//     Route::delete('/post/delete/{id}', 'deletePostFromDb')->name('post.delete');
//     Route::put('/post/update/{id}', 'updatePost')->name('post.update');
// });



// |> Routes for authentication
Route::group(['prefix' => '/auth'], function () {

    Route::post('/login', [AuthController::class, 'loginUser'])->name('auth.login');
    Route::post('/register', [AuthController::class, 'registerUser'])->name('auth.register');

    Route::middleware(['auth:web'])->group(function () {
        Route::get('/logout', [AuthController::class, 'logoutUser'])->name('auth.logout');
    });
});




/*

// jQuery, bind an event handler or use some other way to trigger ajax call.
$('form').submit(function( event ) {
    event.preventDefault();
    $.ajax({
        url: 'http://myserver.dev/myAjaxCallURI',
        type: 'post',
        data: $('form').serialize(), // Remember that you need to have your csrf token included
        dataType: 'json',
        success: function( _response ){
            // Handle your response..
        },
        error: function( _response ){
            // Handle error
        }
    });
});

*/
