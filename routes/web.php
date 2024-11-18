<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

// Routes voor authenticatie
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'loginForm')->name('login');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->name('logout');
    Route::get('/register', 'registerForm')->name('register');
    Route::post('/register', 'register');
    Route::get('/password/reset', 'showResetForm')->name('password.request');
    Route::post('/password/reset', 'reset');
});

// Routes voor profielen
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Routes voor admins
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::resource('news', NewsController::class);
    Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users');
    Route::post('/admin/users/{user}/promote', [AdminController::class, 'promote'])->name('admin.promote');
    Route::post('/admin/users/{user}/demote', [AdminController::class, 'demote'])->name('admin.demote');
});
