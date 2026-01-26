<?php
// app/Services/Payroll/Strategies/AdminStrategy.php
namespace App\Services\Payroll\Strategies;

class AdminStrategy implements SalaryStrategyInterface
{
    public function calculate(float $baseSalary, array $data, int $yearsOfService): float
    {
        // Logika Tunjangan
        $percentage = 0;

        if ($yearsOfService >= 5) {
            $percentage = 0.03; // 3%
        } elseif ($yearsOfService >= 3) {
            $percentage = 0.01; // 1%
        }

        return $baseSalary + ($baseSalary * $percentage);
    }
}
