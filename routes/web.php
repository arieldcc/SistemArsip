<?php

use App\Http\Controllers\ArsipController;
use App\Http\Controllers\BagianController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('content');
// });

// routes/web.php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DisposisiControler;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\SuratmasukController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Row;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/home', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware(['auth'])->group(function(){
    Route::controller(BagianController::class)->group(function(){
        Route::get('/bagian','index');
        Route::get('/bagian/create','create');
        Route::post('/bagian/store','store');
        Route::get('/bagian/{id}', 'show_data');
        Route::get('/bagian/{id}/edit', 'show_edit');
        Route::put('/bagian/{id}', 'update');
        Route::delete('/bagian/{id}', 'delete');
    });

    Route::controller(SuratmasukController::class)->group(function(){
        Route::get('/surat-masuk', 'index');
        Route::get('/surat-masuk/create', 'create');
        Route::post('/surat-masuk/store', 'store');
        Route::get('/surat-masuk/{id}', 'show_data');
        Route::get('/surat-masuk/{id}/edit', 'show_edit');
        Route::put('/surat-masuk/{id}', 'update');
        Route::delete('/surat-masuk/{id}', 'delete');
    });

    Route::controller(DisposisiControler::class)->group(function(){
        Route::get('/disposisi', 'index');
        Route::get('/disposisi/laporan', 'report');
    });

    Route::controller(SuratKeluarController::class)->group(function(){
        Route::get('/surat-keluar', 'index');
        Route::get('/surat-keluar/create', 'create');
        Route::post('/surat-keluar/store', 'store');
        Route::get('/surat-keluar/{id}', 'show_data');
        Route::get('/surat-keluar/{id}/edit', 'show_edit');
        Route::put('/surat-keluar/{id}', 'update');
        Route::delete('/surat-keluar/{id}', 'delete');
    });

    Route::controller(ArsipController::class)->group(function(){
        Route::get('/arsip', 'index');
        Route::get('/arsip/{type}/{id}', 'show_detail');
    });

    Route::controller(LaporanController::class)->group(function(){
        Route::get('/laporan', 'index');
        Route::get('/laporan/bagian', 'laporanBagian');
        Route::get('/laporan/surat-masuk', 'laporanSuratMasuk');
        Route::get('/laporan/disposisi', 'laporanDisposisi');
        Route::get('/laporan/surat-keluar', 'laporanSuratKeluar');
    });

    Route::controller(UserController::class)->group(function(){
        Route::get('/user-management', 'index');
        Route::get('/user-management/create', 'create');
        Route::post('/user-management/store', 'store');
        Route::get('/user-management/{id}/edit', 'show_edit');
        Route::put('/user-management/{id}', 'update');
        Route::delete('/user-management/{id}', 'delete');
    });
});


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
