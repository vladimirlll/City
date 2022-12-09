<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'show'])->name('home');
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::get('/signup', [SignupController::class, 'show'])->name('signup');
Route::post('/register', [SignupController::class, 'register'])->name('register');
Route::post('/auth', [LoginController::class, 'auth'])->name('auth');
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
Route::post('/user/{id}/save', [UserController::class, 'save']);
Route::get('/user/{id}/edit', [UserController::class, 'edit']);
Route::get('/user/{id}', [UserController::class, 'show']);
Route::get('/user/{myId}/review/to/{anotherId}', [UserController::class, 'review']);
Route::get('/user/{myId}/send/to/{anotherId}', [UserController::class, 'send']);
Route::get('/user/{id}/consultations', [UserController::class, 'showConsultations']);
Route::get('/test', [TestController::class, 'show']);
