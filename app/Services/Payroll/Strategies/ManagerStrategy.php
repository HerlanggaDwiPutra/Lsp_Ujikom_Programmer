<?php
// app/Services/Payroll/Strategies/ManagerStrategy.php
namespace App\Services\Payroll\Strategies;

class ManagerStrategy implements SalaryStrategyInterface
{
    public function calculate(float $baseSalary, array $data, int $yearsOfService): float
    {
        $growth = $data['sales_growth_percentage'] ?? 0;

        // Logika Bonus
        $bonusPercentage = 0;

        if ($growth > 10) {
            $bonusPercentage = 0.10;
        } elseif ($growth >= 6) {
            $bonusPercentage = 0.05;
        } elseif ($growth >= 1) {
            $bonusPercentage = 0.02;
        }

        return $baseSalary + ($baseSalary * $bonusPercentage);
    }
}
