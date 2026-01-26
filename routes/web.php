<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SortingController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\ElectricityTariffController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BillController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Dokumentasi Route:
| 1. /          : Dashboard Utama (Integrasi)
| 2. /sorting   : Modul Pengurutan Angka
| 3. /payroll   : Modul Penggajian
| 4. /listrik   : Modul Listrik (Tarif, Pelanggan, Tagihan)
|
*/

// --- 1. Dashboard Utama ---
Route::get('/', [HomeController::class, 'index'])->name('home');

// --- 2. Modul Pengurutan Angka ---
Route::prefix('sorting')->name('sorting.')->group(function () {
    Route::get('/', [SortingController::class, 'index'])->name('index');
    Route::post('/process', [SortingController::class, 'process'])->name('process');
    Route::get('/download/{id}', [SortingController::class, 'download'])->name('download');
});

// --- 3. Modul Penggajian ---
Route::prefix('payroll')->name('payroll.')->group(function () {
    Route::get('/', [PayrollController::class, 'index'])->name('index');
    Route::post('/calculate', [PayrollController::class, 'calculate'])->name('calculate');
});

// --- 4. Modul Data Listrik (CRUD) ---
// Menggunakan Resource Controller agar efisien (Best Practice)
Route::prefix('listrik')->name('listrik.')->group(function () {

    // CRUD Tarif Listrik
    // Parameter 'tarif' diubah agar sesuai dengan model binding
    Route::resource('tarif', ElectricityTariffController::class)->parameters([
        'tarif' => 'electricityTariff'

    ]);
    // CRUD Pelanggan (Tambahkan baris ini di dalam group prefix 'listrik')
    // Parameter 'pelanggan' kita mapping ke model 'customer'
    Route::resource('pelanggan', CustomerController::class)->parameters([
        'pelanggan' => 'customer'
    ]);
    // CRUD Tagihan
    Route::resource('tagihan', BillController::class)->parameters([
        'tagihan' => 'bill'
    ]);
    // Placeholder untuk Pelanggan & Tagihan (Akan dibuat di tahap berikutnya)
    // Route::resource('pelanggan', CustomerController::class);
    // Route::resource('tagihan', BillController::class);
});
