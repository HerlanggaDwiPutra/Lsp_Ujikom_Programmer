<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PayrollTest extends TestCase
{
    use RefreshDatabase;

    public function test_calculate_payroll_for_satpam()
    {
        // PERBAIKAN DI SINI: Tambahkan join_date dan base_salary
        $employee = Employee::create([
            'nip' => '12345',
            'name' => 'Budi Satpam',
            'role' => 'satpam',
            'join_date' => '2020-01-01', // Wajib ada
            'base_salary' => 3000000,    // Wajib ada
        ]);

        $inputData = [
            'employee_id' => $employee->id,
            'overtime_hours' => 5,
        ];

        $response = $this->post(route('payroll.calculate'), $inputData);

        $response->assertStatus(200);
    }

    public function test_payroll_validation_fails_if_empty()
    {
        $response = $this->post(route('payroll.calculate'), []);
        $response->assertSessionHasErrors(['employee_id']);
    }
}
