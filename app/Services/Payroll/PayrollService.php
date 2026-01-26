<?php
// app/Services/Payroll/PayrollService.php
declare(strict_types=1);

namespace App\Services\Payroll;

use App\Services\Payroll\Strategies\{
    SalaryStrategyInterface, SecurityStrategy, SalesStrategy, AdminStrategy, ManagerStrategy
};
use App\Models\Employee;
use App\Models\SalarySlip;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

class PayrollService
{
    /**
     * Factory Method untuk memilih strategi berdasarkan role.
     * Ini adalah penerapan Polymorphism.
     */
    private function getStrategy(string $role): SalaryStrategyInterface
    {
        return match ($role) {
            'satpam' => new SecurityStrategy(),
            'sales' => new SalesStrategy(),
            'admin' => new AdminStrategy(),
            'manager' => new ManagerStrategy(),
            default => throw new \InvalidArgumentException("Role tidak dikenali"),
        };
    }

    /**
     * Memproses gaji dan menyimpan ke database.
     */
    public function processPayroll(Employee $employee, array $inputData): SalarySlip
    {
        Log::info("Payroll: Memulai perhitungan untuk {$employee->name} ({$employee->role})");

        // 1. Pilih Strategi
        $strategy = $this->getStrategy($employee->role);

        // 2. Hitung Tahun Masuk Kerja
        $yearsOfService = (int) $employee->join_date->diffInYears(now());

        // 3. Eksekusi Perhitungan (Polymorphism)
        $finalSalary = $strategy->calculate((float)$employee->base_salary, $inputData, $yearsOfService);

        // 4. Simpan ke Database
        $slip = SalarySlip::create([
            'employee_id' => $employee->id,
            'input_variables' => $inputData,
            'final_salary' => $finalSalary,
            'generated_at' => now(),
        ]);

        Log::info("Payroll: Sukses. Total Gaji: {$finalSalary}");

        return $slip;
    }

    /**
     * Menggunakan Library DomPDF untuk generate PDF.
     */
    public function generatePdf(SalarySlip $slip)
    {
        $employee = $slip->employee;

        // Load view khusus PDF
        $pdf = Pdf::loadView('payroll.pdf_slip', compact('slip', 'employee'));

        return $pdf->download("Slip_Gaji_{$employee->nip}.pdf");
    }
}
