<?php

namespace App\Services\Payroll\Strategies;

class AdminStrategy implements SalaryStrategyInterface
{
    public function calculate(float $baseSalary, array $data, int $yearsOfService): float
    {

        $percentage = 0;

        if ($yearsOfService >= 5) {
            // Lama kerja >= 5 tahun: 3% 
            $percentage = 0.03;
        } elseif ($yearsOfService >= 3) {
            // Lama kerja >= 3 tahun: 1%
            $percentage = 0.01;
        }
        // Kurang dari 3 tahun: 0% (Default)

        return $baseSalary + ($baseSalary * $percentage);
    }
}
