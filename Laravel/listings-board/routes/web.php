<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Middleware\LogRequest;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::resource('jobs', JobController::class)->middleware('auth')->only(['create', 'edit', 'update', 'destroy']);
Route::resource('jobs', JobController::class)->except(['create', 'edit', 'update', 'destroy']);

Route::resource('dashboard', DashboardController::class);
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');

Route::middleware('guest')->group(function () {

    Route::get('/register', [RegisterController::class, 'register'])->name('register')->middleware('guest');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
    Route::get('/login', [LoginController::class, 'login'])->name('login')->middleware(LogRequest::class, 'guest');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');

});
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');


