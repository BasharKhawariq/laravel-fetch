<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RandomUserController;
use App\Http\Controllers\DashboardController;

Route::resource('random-users', RandomUserController::class);

// Route untuk menampilkan halaman dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Route untuk mengedit data user
Route::get('/users/{user}/edit', [RandomUserController::class, 'edit'])->name('users.edit');

// Route untuk mengupdate data user
Route::put('/users/{user}', [RandomUserController::class, 'update'])->name('users.update');

// Route untuk mengupdate data user
Route::post('/users/', [RandomUserController::class, 'create'])->name('users.create');

// Route untuk menghapus data user
Route::delete('/users/{user}', [RandomUserController::class, 'destroy'])->name('users.destroy');


