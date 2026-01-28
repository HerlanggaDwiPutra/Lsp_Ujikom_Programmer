<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    // 1. Menampilkan Daftar Pegawai
    public function index()
    {
        $employees = Employee::latest()->paginate(10);
        return view('payroll.employee.index', compact('employees'));
    }

    // 2. Form Tambah
    public function create()
    {
        return view('payroll.employee.create');
    }

    // 3. Simpan Data
    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|unique:employees,nip',
            'name' => 'required|string|max:100',
            'join_year' => 'required|integer|min:1990|max:'.(date('Y')),
            'base_salary' => 'required|numeric|min:0',
            'role' => 'required|in:satpam,sales,admin,manager',
        ]);

        Employee::create($request->all());

        return redirect()->route('payroll.pegawai.index')
            ->with('success', 'Data Pegawai berhasil ditambahkan!');
    }

    // 4. Form Edit
    public function edit(Employee $employee)
    {
        return view('payroll.employee.edit', compact('employee'));
    }

    // 5. Update Data
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'nip' => 'required|unique:employees,nip,' . $employee->id,
            'name' => 'required|string|max:100',
            'join_year' => 'required|integer|min:1990|max:'.(date('Y')),
            'base_salary' => 'required|numeric|min:0',
            'role' => 'required|in:satpam,sales,admin,manager',
        ]);

        $employee->update($request->all());

        return redirect()->route('payroll.pegawai.index')
            ->with('success', 'Data Pegawai diperbarui!');
    }

    // 6. Hapus Data
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('payroll.pegawai.index')
            ->with('success', 'Data Pegawai dihapus!');
    }
}
