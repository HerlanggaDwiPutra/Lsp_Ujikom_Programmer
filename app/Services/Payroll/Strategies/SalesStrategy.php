<?php

// app/Services/Payroll/Strategies/SalesStrategy.php
namespace App\Services\Payroll\Strategies;

class SalesStrategy implements SalaryStrategyInterface
{
    public function calculate(float $baseSalary, array $data, int $yearsOfService): float
    {
        $customers = $data['total_customers'] ?? 0;

        // Rumus: Gaji + (Pelanggan * 50.000)
        return $baseSalary + ($customers * 50000);
    }
}
