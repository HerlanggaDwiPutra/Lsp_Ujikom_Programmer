<?php

// app/Http/Controllers/PayrollController.php
namespace App\Http\Controllers;

use App\Models\Employee;
use App\Services\Payroll\PayrollService;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    public function __construct(protected PayrollService $service) {}

    public function index()
    {
        // Best Practice: Load data pegawai untuk dropdown
        $employees = Employee::all();
        return view('payroll.index', compact('employees'));
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            // Validasi dinamis bisa ditambahkan di sini
        ]);

        $employee = Employee::find($request->employee_id);

        // Ambil semua input user (jam lembur, jumlah sales, dll)
        $inputData = $request->except(['_token', 'employee_id']);

        $slip = $this->service->processPayroll($employee, $inputData);

        return $this->service->generatePdf($slip);
    }
}
