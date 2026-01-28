<?php
namespace App\Services\Payroll\Strategies;

class SalesStrategy implements SalaryStrategyInterface
{
    public function calculate(float $baseSalary, array $inputData, int $yearsOfService): float
    {
        // Komisi = jumlah pelanggan * 50.000
        $totalCustomers = $inputData['total_customers'] ?? 0;
        $commission = $totalCustomers * 50000;

        return $baseSalary + $commission;
    }
}
