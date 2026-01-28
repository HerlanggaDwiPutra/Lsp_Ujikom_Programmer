@extends('layouts.main')

@section('title', 'Edit Pegawai')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md border border-gray-200">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Edit Data Pegawai</h2>
        <a href="{{ route('payroll.pegawai.index') }}" class="text-sm text-gray-500 hover:text-black">&larr; Kembali</a>
    </div>

    <form action="{{ route('payroll.pegawai.update', $employee->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">NIP</label>
                <input type="text" name="nip" value="{{ old('nip', $employee->nip) }}" class="w-full border border-gray-300 p-2 rounded focus:ring-black focus:border-black" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $employee->name) }}" class="w-full border border-gray-300 p-2 rounded focus:ring-black focus:border-black" required>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Masuk</label>
                <input type="number" name="join_year" value="{{ old('join_year', $employee->join_year) }}" class="w-full border border-gray-300 p-2 rounded focus:ring-black focus:border-black" required min="1990" max="{{ date('Y') }}">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Gaji Pokok (Rp)</label>
                <input type="number" name="base_salary" value="{{ old('base_salary', $employee->base_salary) }}" class="w-full border border-gray-300 p-2 rounded focus:ring-black focus:border-black" required>
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">Jabatan</label>
            <select name="role" class="w-full border border-gray-300 p-2 rounded focus:ring-black focus:border-black">
                @foreach(['satpam', 'sales', 'admin', 'manager'] as $role)
                    <option value="{{ $role }}" {{ old('role', $employee->role) == $role ? 'selected' : '' }}>
                        {{ ucfirst($role) }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="w-full bg-black text-white font-bold py-3 rounded hover:bg-gray-800 transition">
            Update Data Pegawai
        </button>
    </form>
</div>
@endsection
