<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserApiController;
use App\Http\Controllers\MovieApiController;

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

//for user related functions
Route::post('/login', [UserApiController::class, 'loginApi']);
Route::post('/logout', [UserApiController::class, 'logoutApi'])->middleware('auth:sanctum');
Route::post('/register', [UserApiController::class, 'registerApi']);

//for movie related functions
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/', [MovieApiController::class, 'showMoviesApi']);
    Route::get('/movie/detail/{movie}', [MovieApiController::class, 'showMovieDetailsApi']);
    Route::post('/add-movie', [ MovieApiController::class, 'createMovieApi']);
    Route::delete('/movie/delete/{movie}', [MovieApiController::class, 'deleteMovieApi']);
    Route::put('/movie/edit/{movie}', [MovieController::class, 'editMovieApi']);
});

