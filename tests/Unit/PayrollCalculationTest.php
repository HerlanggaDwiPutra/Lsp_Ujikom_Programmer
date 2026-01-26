<?php
// tests/Unit/PayrollCalculationTest.php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\Payroll\Strategies\SecurityStrategy;
use App\Services\Payroll\Strategies\ManagerStrategy;

class PayrollCalculationTest extends TestCase
{
    /**
     * Skenario: Satpam lembur 5 jam.
     * Gaji Pokok: 3.000.000
     * Ekspektasi: 3.000.000 + (5 * 20.000) = 3.100.000
     */
    public function test_security_salary_calculation()
    {
        $strategy = new SecurityStrategy();
        $baseSalary = 3000000;
        $data = ['overtime_hours' => 5];

        $result = $strategy->calculate($baseSalary, $data, 0);

        $this->assertEquals(3100000, $result);
    }

    /**
     * Skenario: Manajer penjualan naik 12% (Bonus 10%).
     * Gaji Pokok: 10.000.000
     * Ekspektasi: 10.000.000 + (10% * 10jt) = 11.000.000
     */
    public function test_manager_bonus_calculation()
    {
        $strategy = new ManagerStrategy();
        $baseSalary = 10000000;
        $data = ['sales_growth_percentage' => 12]; // Di atas 10%

        $result = $strategy->calculate($baseSalary, $data, 5);

        $this->assertEquals(11000000, $result);
    }
}
