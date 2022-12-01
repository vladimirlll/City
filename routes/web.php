<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\TestController;
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
