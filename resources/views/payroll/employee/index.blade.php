@extends('layouts.main')

@section('title', 'Data Pegawai')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Data Pegawai (PT Argo Industri)</h2>
    <a href="{{ route('payroll.pegawai.create') }}" class="bg-black text-white px-4 py-2 rounded hover:bg-gray-800 transition shadow-sm text-sm font-medium">
        + Tambah Pegawai
    </a>
</div>

@if(session('success'))
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 border border-green-200" role="alert">
        <span class="font-medium">Sukses!</span> {{ session('success') }}
    </div>
@endif

<div class="relative overflow-x-auto shadow-md sm:rounded-lg border border-gray-200">
    <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
            <tr>
                <th scope="col" class="px-6 py-3">NIP</th>
                <th scope="col" class="px-6 py-3">Nama Lengkap</th>
                <th scope="col" class="px-6 py-3">Jabatan</th>
                <th scope="col" class="px-6 py-3">Tahun Masuk</th>
                <th scope="col" class="px-6 py-3">Gaji Pokok</th>
                <th scope="col" class="px-6 py-3 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($employees as $emp)
            <tr class="bg-white border-b hover:bg-gray-50">
                <td class="px-6 py-4 font-medium text-gray-900">{{ $emp->nip }}</td>
                <td class="px-6 py-4">{{ $emp->name }}</td>
                <td class="px-6 py-4">
                    <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded border border-gray-300">
                        {{ ucfirst($emp->role) }}
                    </span>
                </td>
                <td class="px-6 py-4">{{ $emp->join_year }}</td>
                <td class="px-6 py-4">Rp {{ number_format($emp->base_salary, 0, ',', '.') }}</td>
                <td class="px-6 py-4 text-center space-x-2">
                    <a href="{{ route('payroll.pegawai.edit', $emp->id) }}" class="font-medium text-blue-600 hover:underline">Edit</a>

                    <form action="{{ route('payroll.pegawai.destroy', $emp->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin hapus pegawai ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="font-medium text-red-600 hover:underline">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-4 text-center text-gray-400">Belum ada data pegawai.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $employees->links() }}
</div>
@endsection
