<?php
// app/Services/Payroll/Strategies/SalaryStrategyInterface.php
namespace App\Services\Payroll\Strategies;

interface SalaryStrategyInterface
{
    /**
     * Menghitung gaji akhir berdasarkan aturan bisnis.
     * @param float $baseSalary Gaji Pokok
     * @param array $data Data variabel (jam lembur, omset, dll)
     * @param int $yearsOfService Lama bekerja (tahun)
     */
    public function calculate(float $baseSalary, array $data, int $yearsOfService): float;
}
