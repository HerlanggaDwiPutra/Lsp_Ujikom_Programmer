<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Services\Payroll\PayrollService;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    // Inject PayrollService
    public function __construct(protected PayrollService $service) {}

    /**
     * Halaman Utama Payroll
     */
    public function index()
    {
        // Ambil semua data pegawai untuk ditampilkan di dropdown
        $employees = Employee::all();
        return view('payroll.index', compact('employees'));
    }

    /**
     * Proses Hitung Gaji
     */
    public function calculate(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            // Validasi input angka (opsional tapi disarankan)
            'overtime_hours' => 'nullable|numeric|min:0',
            'total_customers' => 'nullable|numeric|min:0',
            'sales_growth_percentage' => 'nullable|numeric',
        ]);

        // 2. Ambil Data Pegawai
        $employee = Employee::findOrFail($request->employee_id);

        // 3. Ambil Input Variabel (Lembur, Sales, dll)
        $inputData = $request->except(['_token', 'employee_id']);

        // 4. Panggil Service untuk Proses Hitung & Simpan
        $slip = $this->service->processPayroll($employee, $inputData);

        // 5. Generate & Download PDF
        return $this->service->generatePdf($slip);
    }
}
