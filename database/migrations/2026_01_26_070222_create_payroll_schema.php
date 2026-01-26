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
    Schema::create('employees', function (Blueprint $table) {
        $table->id();
        $table->string('nip')->unique();
        $table->string('name');
        $table->enum('role', ['satpam', 'sales', 'admin', 'manager']);
        $table->date('join_date'); // Untuk menghitung lama kerja admin
        $table->decimal('base_salary', 15, 2);
        $table->timestamps();
    });

    Schema::create('salary_slips', function (Blueprint $table) {
        $table->id();
        $table->foreignId('employee_id')->constrained()->cascadeOnDelete();
        $table->json('input_variables'); // Menyimpan input dinamis (jam lembur/sales/dll)
        $table->decimal('final_salary', 15, 2);
        $table->timestamp('generated_at');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary_slips');
        Schema::dropIfExists('employees');
    }
};
