<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BalitaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IbuHamilController;
use App\Http\Controllers\ImunisasiController;
use App\Http\Controllers\LansiaController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PeriksaBalitaController;
use App\Http\Controllers\PeriksaIbuHamilController;
use App\Http\Controllers\PeriksaLansiaController;
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
        // Kelola Imunisasi
        Route::resource('imunisasi', ImunisasiController::class);
        // Pendaftaran Balita
        Route::get('balita/pendaftaraan', [BalitaController::class, 'pendaftaran'])->name('balita.pendaftaran');
        Route::post('balita/pendaftaraan/post', [BalitaController::class, 'pendaftaran_store'])->name('balita.pendaftaran.post');
        // List Balita
        Route::get('balita/list', [BalitaController::class, 'list'])->name('balita.list');
        // Lihat Detail Balita
        Route::get('balita/detail/{id}', [BalitaController::class, 'detail'])->name('balita.detail');
        // Edit Data Balita
        Route::get('balita/edit/{id}', [BalitaController::class, 'edit'])->name('balita.edit');
        Route::post('balita/edit/{id}/post', [BalitaController::class, 'edit_store'])->name('balita.edit.post');
        // Pemeriksaan Balita
        Route::get('balita/pemeriksaan', [PeriksaBalitaController::class, 'pemeriksaan'])->name('balita.pemeriksaan');
        Route::get('balita/pemeriksaan/cari', [PeriksaBalitaController::class, 'pemeriksaan_cari'])->name('balita.pemeriksaan.cari');
        Route::get('balita/pemeriksaan/cari?tanggal={tanggal}', [PeriksaBalitaController::class, 'pemeriksaan_cari'])->name('balita.pemeriksaan.cari.tanggal');
        Route::get('balita/pemeriksaan/{id}_{tanggal}', [PeriksaBalitaController::class, 'pemeriksaan_input'])->name('balita.pemeriksaan.input');
        Route::get('balita/pemeriksaan/edit/{id}_{tanggal}', [PeriksaBalitaController::class, 'pemeriksaan_edit'])->name('balita.pemeriksaan.edit');
        Route::post('balita/pemeriksaan/update/{id}_{tanggal}', [PeriksaBalitaController::class, 'pemeriksaan_update'])->name('balita.pemeriksaan.update');
        Route::post('balita/pemeriksaan/store/{id}_{tanggal}', [PeriksaBalitaController::class, 'pemeriksaan_store'])->name('balita.pemeriksaan.store');
        // Hapus Data Balita
        Route::delete('balita/destroy/{id}', [BalitaController::class, 'destroy'])->name('balita.destroy');
        // Laporan Balita
        Route::post('balita/list/laporan', [BalitaController::class, 'laporan_pendaftaran'])->name('balita.list.laporan');
        Route::post('balita/pemeriksaan/laporan', [PeriksaBalitaController::class, 'laporan_pemeriksaan'])->name('balita.pemeriksaan.laporan');
        Route::post('balita/pemeriksaan/kehadiran/laporan', [PeriksaBalitaController::class, 'laporan_kehadiran'])->name('balita.pemeriksaan.kehadiran.laporan');

        // Pendaftaran Ibu Hamil
        Route::get('ibu_hamil/pendaftaraan', [IbuHamilController::class, 'pendaftaran'])->name('ibu_hamil.pendaftaran');
        Route::post('ibu_hamil/pendaftaraan/post', [IbuHamilController::class, 'pendaftaran_store'])->name('ibu_hamil.pendaftaran.post');
        // List Ibu Hamil
        Route::get('ibu_hamil/list', [IbuHamilController::class, 'list'])->name('ibu_hamil.list');
        // Lihat Detail Ibu Hamil
        Route::get('ibu_hamil/detail/{id}', [IbuHamilController::class, 'detail'])->name('ibu_hamil.detail');
        // Edit Data Ibu Hamil
        Route::get('ibu_hamil/edit/{id}', [IbuHamilController::class, 'edit'])->name('ibu_hamil.edit');
        Route::post('ibu_hamil/edit/{id}/post', [IbuHamilController::class, 'edit_store'])->name('ibu_hamil.edit.post');
        // Pemeriksaan Ibu Hamil
        Route::get('ibu_hamil/pemeriksaan', [PeriksaIbuHamilController::class, 'pemeriksaan'])->name('ibu_hamil.pemeriksaan');
        Route::get('ibu_hamil/pemeriksaan/cari', [PeriksaIbuHamilController::class, 'pemeriksaan_cari'])->name('ibu_hamil.pemeriksaan.cari');
        Route::get('ibu_hamil/pemeriksaan/cari?tanggal={tanggal}', [PeriksaIbuHamilController::class, 'pemeriksaan_cari'])->name('ibu_hamil.pemeriksaan.cari.tanggal');
        Route::get('ibu_hamil/pemeriksaan/{id}_{tanggal}', [PeriksaIbuHamilController::class, 'pemeriksaan_input'])->name('ibu_hamil.pemeriksaan.input');
        Route::get('ibu_hamil/pemeriksaan/edit/{id}_{tanggal}', [PeriksaIbuHamilController::class, 'pemeriksaan_edit'])->name('ibu_hamil.pemeriksaan.edit');
        Route::post('ibu_hamil/pemeriksaan/update/{id}_{tanggal}', [PeriksaIbuHamilController::class, 'pemeriksaan_update'])->name('ibu_hamil.pemeriksaan.update');
        Route::post('ibu_hamil/pemeriksaan/store/{id}_{tanggal}', [PeriksaIbuHamilController::class, 'pemeriksaan_store'])->name('ibu_hamil.pemeriksaan.store');
        // Hapus Data Ibu Hamil
        Route::delete('ibu_hamil/destroy/{id}', [IbuHamilController::class, 'destroy'])->name('ibu_hamil.destroy');
        // Laporan Ibu Hamil
        Route::post('ibu_hamil/list/laporan', [IbuHamilController::class, 'laporan_pendaftaran'])->name('ibu_hamil.list.laporan');
        Route::post('ibu_hamil/pemeriksaan/laporan', [PeriksaIbuHamilController::class, 'laporan_pemeriksaan'])->name('ibu_hamil.pemeriksaan.laporan');
        Route::post('ibu_hamil/pemeriksaan/kehadiran/laporan', [PeriksaIbuHamilController::class, 'laporan_kehadiran'])->name('ibu_hamil.pemeriksaan.kehadiran.laporan');

        // Pendaftaran Lansia
        Route::get('lansia/pendaftaraan', [LansiaController::class, 'pendaftaran'])->name('lansia.pendaftaran');
        Route::post('lansia/pendaftaraan/post', [LansiaController::class, 'pendaftaran_store'])->name('lansia.pendaftaran.post');
        // List Lansia
        Route::get('lansia/list', [LansiaController::class, 'list'])->name('lansia.list');
        // Lihat Detail Lansia
        Route::get('lansia/detail/{id}', [LansiaController::class, 'detail'])->name('lansia.detail');
        // Edit Data Lansia
        Route::get('lansia/edit/{id}', [LansiaController::class, 'edit'])->name('lansia.edit');
        Route::post('lansia/edit/{id}/post', [LansiaController::class, 'edit_store'])->name('lansia.edit.post');
        // Pemeriksaan Lansia
        Route::get('lansia/pemeriksaan', [PeriksaLansiaController::class, 'pemeriksaan'])->name('lansia.pemeriksaan');
        Route::get('lansia/pemeriksaan/cari', [PeriksaLansiaController::class, 'pemeriksaan_cari'])->name('lansia.pemeriksaan.cari');
        Route::get('lansia/pemeriksaan/cari?tanggal={tanggal}', [PeriksaLansiaController::class, 'pemeriksaan_cari'])->name('lansia.pemeriksaan.cari.tanggal');
        Route::get('lansia/pemeriksaan/{id}_{tanggal}', [PeriksaLansiaController::class, 'pemeriksaan_input'])->name('lansia.pemeriksaan.input');
        Route::get('lansia/pemeriksaan/edit/{id}_{tanggal}', [PeriksaLansiaController::class, 'pemeriksaan_edit'])->name('lansia.pemeriksaan.edit');
        Route::post('lansia/pemeriksaan/update/{id}_{tanggal}', [PeriksaLansiaController::class, 'pemeriksaan_update'])->name('lansia.pemeriksaan.update');
        Route::post('lansia/pemeriksaan/store/{id}_{tanggal}', [PeriksaLansiaController::class, 'pemeriksaan_store'])->name('lansia.pemeriksaan.store');
        // Hapus Data Lansia
        Route::delete('lansia/destroy/{id}', [LansiaController::class, 'destroy'])->name('lansia.destroy');
        // Laporan Balita
        Route::post('lansia/list/laporan', [LansiaController::class, 'laporan_pendaftaran'])->name('lansia.list.laporan');
        Route::post('lansia/pemeriksaan/laporan', [PeriksaLansiaController::class, 'laporan_pemeriksaan'])->name('lansia.pemeriksaan.laporan');
        Route::post('lansia/pemeriksaan/kehadiran/laporan', [PeriksaLansiaController::class, 'laporan_kehadiran'])->name('lansia.pemeriksaan.kehadiran.laporan');
    });
});
