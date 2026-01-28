<?php
namespace App\Services\Payroll\Strategies;

class SecurityStrategy implements SalaryStrategyInterface
{
    public function calculate(float $baseSalary, array $inputData, int $yearsOfService): float
    {
        // Honor lembur = jam lembur * 20.000
        $overtimeHours = $inputData['overtime_hours'] ?? 0;
        $overtimePay = $overtimeHours * 20000;

        return $baseSalary + $overtimePay;
    }
}
