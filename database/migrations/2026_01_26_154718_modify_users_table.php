<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menyesuaikan tabel user default dengan spesifikasi:
     * id, username, password, hak_akses
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Hapus kolom default yang tidak diminta (opsional, tapi agar bersih)
            $table->dropColumn(['email', 'email_verified_at', 'name']);

            // Tambah kolom sesuai spek
            $table->string('username', 50)->unique()->after('id');
            $table->integer('hak_akses')->comment('1: Admin, 2: Petugas, etc')->after('password');
        });
    }

    public function down(): void
    {
        // Rollback logic
        Schema::table('users', function (Blueprint $table) {
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->dropColumn(['username', 'hak_akses']);
        });
    }
};
