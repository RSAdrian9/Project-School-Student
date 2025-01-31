<?php

use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Rutas para Schools
Route::resource('schools', SchoolController::class);

// Rutas para Students
Route::resource('students', StudentController::class);
