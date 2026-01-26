<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Mengisi database dengan data pegawai untuk pengujian logika gaji.
     */
    public function run(): void
    {
        // 1. Satpam (Gaji Pokok + Lembur)
        Employee::create([
            'nip' => 'SEC001',
            'name' => 'Budi Santoso (Satpam)',
            'role' => 'satpam',
            'join_date' => '2020-01-01',
            'base_salary' => 3000000,
        ]);

        // 2. Sales (Gaji Pokok + Komisi Pelanggan)
        Employee::create([
            'nip' => 'SAL001',
            'name' => 'Siti Aminah (Sales)',
            'role' => 'sales',
            'join_date' => '2021-05-15',
            'base_salary' => 2500000,
        ]);

        // 3. Administrasi Senior (> 5 Tahun, Tunjangan 3%)
        Employee::create([
            'nip' => 'ADM001',
            'name' => 'Rina Kartika (Admin Senior)',
            'role' => 'admin',
            'join_date' => '2015-01-01', // Lama kerja > 5 tahun
            'base_salary' => 4000000,
        ]);

        // 4. Administrasi Junior (< 3 Tahun, Tunjangan 0%)
        Employee::create([
            'nip' => 'ADM002',
            'name' => 'Doni Pratama (Admin Junior)',
            'role' => 'admin',
            'join_date' => '2024-01-01', // Masih baru
            'base_salary' => 4000000,
        ]);

        // 5. Manajer (Gaji Pokok + Bonus Penjualan)
        Employee::create([
            'nip' => 'MGR001',
            'name' => 'Pak Bos (Manajer)',
            'role' => 'manager',
            'join_date' => '2010-01-01',
            'base_salary' => 10000000,
        ]);
    }
}
