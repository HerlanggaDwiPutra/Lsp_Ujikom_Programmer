<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('electricity_tariffs', function (Blueprint $table) {
            $table->id(); // id: INTEGER(11)
            // Relasi: User menginput Tarif (user_id FK)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('kd_tarif', 10)->unique();
            $table->integer('beban'); // Beban (Watt/VA)
            $table->decimal('tarif_per_kwh', 10, 2); // Menggunakan decimal untuk mata uang presisi
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('electricity_tariffs');
    }
};
