<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sorting_tasks', function (Blueprint $table) {
            $table->id();
            $table->json('input_numbers');   // Menyimpan input [5, 1, 3]
            $table->json('sorted_numbers');  // Menyimpan hasil [1, 3, 5]
            $table->string('file_path');     // Menyimpan lokasi file .txt (Syarat Akses File)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sorting_tasks');
    }
};
