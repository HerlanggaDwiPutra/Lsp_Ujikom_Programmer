<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil EmployeeSeeder di sini agar otomatis dijalankan
        // saat perintah --seed diketik.
        $this->call([
            EmployeeSeeder::class,
            UserSeeder::class,
        ]);
    }
}
