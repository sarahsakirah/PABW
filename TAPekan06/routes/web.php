<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LaporBanjirController;
use App\Models\Laporan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard', ['laporan' => Laporan::latest()->get()]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/laporan', [LaporBanjirController::class, 'index'])->name('laporan.index');
    Route::get('/formlaporbanjir', [LaporBanjirController::class, 'formlaporbanjir'])->name('laporan.create');
    Route::post('/proseslaporbanjir', [LaporBanjirController::class, 'proseslaporbanjir'])->name('laporan.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
