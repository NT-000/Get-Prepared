<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;

Route::get('/', [HomeController::class, 'index']);

Route::get('jobs', [JobController::class, 'index']);

Route::get('jobs/create', [JobController::class, 'create']);
