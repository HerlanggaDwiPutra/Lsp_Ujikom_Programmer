<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            // Relasi: Pelanggan membayar Tagihan (pelanggan_id FK)
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->string('tahun_tagihan', 4);
            $table->integer('bulan_tagihan'); // 1-12
            $table->integer('pemakaian'); // Jumlah meter pemakaian
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
