<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\OpdController;
use App\Http\Controllers\IndikatorController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\SubIndikatorController;

// Login Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('pengguna', PenggunaController::class);
    Route::resource('opd', OpdController::class);
    Route::resource('indikator', IndikatorController::class);
    Route::resource('periode', PeriodeController::class);
    Route::resource('sub-indikator', SubIndikatorController::class);
});
