<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MovieController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//for rerouting to the homepage
Route::get('/', [MovieController::class, 'showMovieHomepage'])->name('login');

//for movie related functions
Route::get('/movie/detail/{movie}', [MovieController::class, 'showMovieDetails'])->middleware('auth');
Route::get('/add-movie', [MovieController::class, 'showCreateMoviePage'])->middleware('auth');
Route::post('/add-movie', [MovieController::class, 'createMovie'])->middleware('auth');
Route::delete('/movie/delete/{movie}', [MovieController::class, 'deleteMovie'])->middleware('auth');
Route::get('/movie/edit/{movie}', [MovieController::class, 'showEditMoviePage'])->middleware('auth');
Route::put('/movie/edit/{movie}', [MovieController::class, 'editMovie'])->middleware('auth');

//for user related functions
Route::post('/login', [UserController::class, 'login'])->middleware('guest');
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');
Route::get('/register', [UserController::class, 'showRegisterPage'])->middleware('guest');
Route::post('/register', [UserController::class, 'register'])->middleware('guest');
