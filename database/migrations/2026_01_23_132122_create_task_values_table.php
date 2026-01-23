<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menjalankan migration untuk membuat tabel.
     * Tabel ini menyimpan riwayat input dan hasil pengurutan.
     */
    public function up(): void
    {
        Schema::create('task_values', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('session_name'); // Nama sesi (contoh: Sesi 2024-01-20)
            $table->json('input_numbers');  // Menyimpan array angka mentah
            $table->json('sorted_numbers'); // Menyimpan array angka yang sudah urut
            $table->string('file_path');    // Lokasi file .txt untuk didownload
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Membatalkan migration (menghapus tabel).
     */
    public function down(): void
    {
        Schema::dropIfExists('task_values');
    }
};
