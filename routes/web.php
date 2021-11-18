<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BalitaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IbuHamilController;
use App\Http\Controllers\LansiaController;
use App\Http\Controllers\PenggunaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth
Route::get('/', [AuthController::class, 'formlogin'])->name('index');
Route::get('login', [AuthController::class, 'formlogin'])->name('login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::post('login', [AuthController::class, 'login'])->name('post-login');

Route::middleware('auth')->group(function () {
    // Home
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    // Kelola Pengguna
    Route::middleware('can:kelola pengguna')->group(function () {
        Route::resource('pengguna', PenggunaController::class);
    });

    // Kelola Data
    Route::middleware('can:kelola data')->group(function () {
        Route::resource('balita', BalitaController::class);
        Route::resource('ibu_hamil', IbuHamilController::class);
        Route::resource('lansia', LansiaController::class);
    });
});
