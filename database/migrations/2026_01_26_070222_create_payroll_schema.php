<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 20)->unique();
            $table->string('name');
            $table->integer('join_year');
            $table->decimal('base_salary', 15, 2);
            $table->enum('role', ['satpam', 'sales', 'admin', 'manager']);
            $table->timestamps();
        });

        Schema::create('salary_slips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');

            // KOLOM BARU (Sesuai Error Anda)
            $table->decimal('base_salary', 15, 2); // Snapshot Gaji Pokok saat itu
            $table->integer('years_of_service');   // Snapshot Lama Kerja saat itu
            $table->json('details')->nullable();   // Ganti 'input_variables' jadi 'details'

            $table->decimal('final_salary', 15, 2);
            $table->timestamp('generated_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('salary_slips');
        Schema::dropIfExists('employees');
    }
};
