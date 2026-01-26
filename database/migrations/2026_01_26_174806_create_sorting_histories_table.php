<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sorting_histories', function (Blueprint $table) {
            $table->id();
            $table->json('input_numbers');  // Menyimpan array angka input
            $table->json('sorted_numbers'); // Menyimpan array hasil sorting
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sorting_histories');
    }
};
