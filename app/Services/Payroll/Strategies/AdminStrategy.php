<?php
namespace App\Services\Payroll\Strategies;

class AdminStrategy implements SalaryStrategyInterface
{
    public function calculate(float $baseSalary, array $inputData, int $yearsOfService): float
    {
        // Tunjangan berdasarkan lama kerja
        $allowanceRate = 0;

        if ($yearsOfService >= 5) {
            $allowanceRate = 0.03; // 3%
        } elseif ($yearsOfService >= 3) {
            $allowanceRate = 0.01; // 1%
        } else {
            $allowanceRate = 0;    // < 3 tahun tidak dapat
        }

        $allowance = $baseSalary * $allowanceRate;
        return $baseSalary + $allowance;
    }
}
