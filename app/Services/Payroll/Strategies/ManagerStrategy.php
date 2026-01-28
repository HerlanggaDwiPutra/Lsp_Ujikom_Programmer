<?php
namespace App\Services\Payroll\Strategies;

class ManagerStrategy implements SalaryStrategyInterface
{
    public function calculate(float $baseSalary, array $inputData, int $yearsOfService): float
    {
        // Bonus berdasarkan persentase peningkatan penjualan
        $increase = $inputData['sales_growth_percentage'] ?? 0;
        $bonusRate = 0;

        if ($increase > 10) {
            $bonusRate = 0.10; // 10%
        } elseif ($increase >= 6) { // 6% - 10%
            $bonusRate = 0.05; // 5%
        } elseif ($increase >= 1) { // 1% - 5%
            $bonusRate = 0.02; // 2%
        } else {
            $bonusRate = 0;    // < 1%
        }

        $bonus = $baseSalary * $bonusRate;
        return $baseSalary + $bonus;
    }
}
