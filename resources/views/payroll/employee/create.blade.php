@extends('layouts.main')

@section('title', 'Tambah Pegawai')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md border border-gray-200">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Input Data Pegawai Baru</h2>
        <a href="{{ route('payroll.pegawai.index') }}" class="text-sm text-gray-500 hover:text-black">&larr; Kembali</a>
    </div>

    <form action="{{ route('payroll.pegawai.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">NIP</label>
                <input type="text" name="nip" value="{{ old('nip') }}" class="w-full border border-gray-300 p-2 rounded focus:ring-black focus:border-black" required placeholder="Contoh: 1001">
                @error('nip') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full border border-gray-300 p-2 rounded focus:ring-black focus:border-black" required placeholder="Nama Pegawai">
                @error('name') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Masuk</label>
                <input type="number" name="join_year" value="{{ old('join_year') }}" class="w-full border border-gray-300 p-2 rounded focus:ring-black focus:border-black" required placeholder="YYYY (Contoh: 2020)" min="1990" max="{{ date('Y') }}">
                @error('join_year') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Gaji Pokok (Rp)</label>
                <input type="number" name="base_salary" value="{{ old('base_salary') }}" class="w-full border border-gray-300 p-2 rounded focus:ring-black focus:border-black" required placeholder="Contoh: 4000000">
                @error('base_salary') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">Jabatan</label>
            <select name="role" class="w-full border border-gray-300 p-2 rounded focus:ring-black focus:border-black">
                <option value="" disabled selected>-- Pilih Jabatan --</option>
                <option value="satpam" {{ old('role') == 'satpam' ? 'selected' : '' }}>Satpam (Security)</option>
                <option value="sales" {{ old('role') == 'sales' ? 'selected' : '' }}>Sales</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrasi</option>
                <option value="manager" {{ old('role') == 'manager' ? 'selected' : '' }}>Manajer</option>
            </select>
            @error('role') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="w-full bg-black text-white font-bold py-3 rounded hover:bg-gray-800 transition">
            Simpan Data Pegawai
        </button>
    </form>
</div>
@endsection
