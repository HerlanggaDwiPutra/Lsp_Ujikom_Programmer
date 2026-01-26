<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Masukkan data admin default
        DB::table('users')->insert([
            'id' => 1, // Kita paksa ID 1 agar sesuai dengan logic controller sementara
            'username' => 'admin',
            'password' => Hash::make('admin123'), // Password aman terenkripsi
            'hak_akses' => 1, // 1: Admin
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
