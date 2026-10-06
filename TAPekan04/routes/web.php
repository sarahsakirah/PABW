<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporBanjirController;

Route::get('/', function () {
    return redirect()->route('laporan.index');
})->name('home');

Route::get('/laporan', [LaporBanjirController::class, 'index'])->name('laporan.index');
Route::get('/formlaporbanjir', [LaporBanjirController::class, 'formlaporbanjir'])->name('laporan.create');
Route::post('/proseslaporbanjir', [LaporBanjirController::class, 'proseslaporbanjir'])->name('laporan.store');
