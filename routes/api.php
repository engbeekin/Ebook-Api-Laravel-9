<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LanguageController;
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

// public routes Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//private  routes only authenticate can acces these routes
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::apiResource('/language', LanguageController::class);
    Route::apiResource('/category', CategoryController::class);
    Route::apiResource('/author', AuthorController::class);
    Route::apiResource('/book', BookController::class);
    Route::post('/logout', [AuthController::class, 'logOut']);
});
