<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            // Relasi: Tarif digunakan Pelanggan (tarif_id FK)
            $table->foreignId('electricity_tariff_id')->constrained('electricity_tariffs')->onDelete('restrict');
            $table->string('nomor_kwh', 20)->unique()->comment('pelanggan_id di soal');
            $table->string('nama_pelanggan', 50);
            $table->text('alamat');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
