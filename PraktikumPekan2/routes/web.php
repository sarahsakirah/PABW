<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporBanjirController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/formlaporbanjir', [LaporBanjirController::class, 'formlaporbanjir']);
Route::post('/proseslaporbanjir', [LaporBanjirController::class, 'proseslaporbanjir']);
