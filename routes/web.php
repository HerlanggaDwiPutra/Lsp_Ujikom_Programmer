<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SortingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini adalah tempat mendaftarkan semua URL aplikasi.
|
*/

// Halaman Utama (Menampilkan Form & Tabel)
Route::get('/', [SortingController::class, 'index'])->name('sorting.index');

// Proses Form (POST data angka)
Route::post('/process', [SortingController::class, 'process'])->name('sorting.process');

// Download File (GET file berdasarkan ID)
Route::get('/download/{id}', [SortingController::class, 'download'])->name('sorting.download');
