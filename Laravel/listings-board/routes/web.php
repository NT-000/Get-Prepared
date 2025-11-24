<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Middleware\LogRequest;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\ApplicantController;

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::middleware('guest')->group(function () {

    Route::get('/register', [RegisterController::class, 'register'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
    Route::get('/login', [LoginController::class, 'login'])->name('login')->middleware(LogRequest::class);
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
});

Route::middleware('auth')->group(function () {

    Route::resource('jobs', JobController::class)->only(['create', 'edit', 'update', 'destroy']);
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/saved', [BookmarkController::class, 'index'])->name('saved.index');
    Route::post('/saved/{job}', [BookmarkController::class, 'store'])->name('saved.store');
    Route::delete('/saved/{job}', [BookmarkController::class, 'destroy'])->name('saved.destroy');

    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
    Route::resource('/jobs', JobController::class)->except(['create', 'edit', 'update', 'destroy']);
    Route::resource('/dashboard', DashboardController::class);
    Route::post('jobs/{job}/apply', [ApplicantController::class, 'store'])->name('jobs.applicants.store');
    Route::get('/jobs/{job}/applicants', [ApplicantController::class, 'index'])->name('jobs.applicants.index');
    Route::delete('/jobs/{job}/applicants/{applicant}', [ApplicantController::class, 'destroy'])->name('jobs.applicants.destroy');
});



