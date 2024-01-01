<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentsController;



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

Route::get('/register', [RegisterController::class, 'create'])->name('register');

Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/login', [LoginController::class, 'show'])->name('login.show');

Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Reset Password routes
// Reset Password routes
Route::get('/reset-password', [ResetPassword::class, 'show'])->name('reset-password.show');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('pages.dashboard');

Route::get('/students', [StudentsController::class, 'index'])->name('students');

Route::post('/students/store', [StudentsController::class, 'store'])->name('students.store');

Route::get('/students/get', [StudentsController::class, 'getStudents'])->name('students.get');

