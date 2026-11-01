<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('lapor.create'));
Route::get('/lapor', [LaporanController::class, 'publicCreate'])->name('lapor.create');
Route::post('/lapor', [LaporanController::class, 'publicStore'])->name('lapor.store');
Route::get('/lapor/terkirim', [LaporanController::class, 'publicSuccess'])->name('lapor.success');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::resource('petugas/laporan', LaporanController::class)
    ->names('petugas.laporan')
    ->middleware('auth');
