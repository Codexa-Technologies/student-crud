<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;

// Default redirect to login
Route::get('/', function() {
    return redirect()->route('login');
});

// ----------------- AUTH ROUTES -----------------
Route::get('register', [AuthController::class, 'showRegister'])->name('register');
Route::post('register', [AuthController::class, 'register']);

Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);

Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// ----------------- PROTECTED CRUD ROUTES -----------------
Route::middleware(['auth.custom'])->group(function(){
    Route::resource('students', StudentController::class);
});
