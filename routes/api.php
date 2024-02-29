


<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// <?php

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Api\AuthController;

// Route::group(['prefix' => '/auth'], function () {

//     Route::post('/login', [AuthController::class, 'loginUser'])->name('auth.login');
//     Route::post('/register', [AuthController::class, 'registerUser'])->name('auth.register');

//     Route::middleware(['auth:web'])->group(function () {
//         Route::get('/logout', [AuthController::class, 'logoutUser'])->name('auth.logout');
//     });

// }
// );
