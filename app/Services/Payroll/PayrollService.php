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
        $yearsOfService = (int) date('Y') - $employee->join_year;

        // 3. Eksekusi Perhitungan
        $finalSalary = $strategy->calculate((float)$employee->base_salary, $inputData, $yearsOfService);

        // 4. Simpan ke Database (UPDATE DI SINI)
        $slip = SalarySlip::create([
            'employee_id' => $employee->id,

            // Simpan data snapshot agar sejarah gaji akurat meskipun data pegawai berubah nanti
            'base_salary' => $employee->base_salary,
            'years_of_service' => $yearsOfService,

            'details' => $inputData, // Simpan input user (lembur, sales, dll)
            'final_salary' => $finalSalary,
            'generated_at' => now(),
        ]);

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
