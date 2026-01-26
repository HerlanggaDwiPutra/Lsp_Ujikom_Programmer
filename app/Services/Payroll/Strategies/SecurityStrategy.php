<?php

// app/Services/Payroll/Strategies/SecurityStrategy.php
namespace App\Services\Payroll\Strategies;

class SecurityStrategy implements SalaryStrategyInterface
{
    public function calculate(float $baseSalary, array $data, int $yearsOfService): float
    {
        // Debugging: Pastikan input ada
        $overtimeHours = $data['overtime_hours'] ?? 0;

        // Rumus: Gaji + (Jam Lembur * 20.000)
        return $baseSalary + ($overtimeHours * 20000);
    }
}
