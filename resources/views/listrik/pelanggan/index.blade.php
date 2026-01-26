@extends('layouts.main')

@section('title', 'Data Pelanggan')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Data Pelanggan Listrik</h2>
    <a href="{{ route('listrik.pelanggan.create') }}" class="bg-black text-white px-4 py-2 rounded hover:bg-gray-800 transition shadow-sm text-sm font-medium">
        + Tambah Pelanggan
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
                <th scope="col" class="px-6 py-3">No. Pelanggan / KWh</th>
                <th scope="col" class="px-6 py-3">Nama Lengkap</th>
                <th scope="col" class="px-6 py-3">Alamat</th>
                <th scope="col" class="px-6 py-3">Jenis Tarif</th>
                <th scope="col" class="px-6 py-3 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($customers as $customer)
            <tr class="bg-white border-b hover:bg-gray-50">
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    {{ $customer->nomor_kwh }}
                </td>
                <td class="px-6 py-4">
                    {{ $customer->nama_pelanggan }}
                </td>
                <td class="px-6 py-4 truncate max-w-xs" title="{{ $customer->alamat }}">
                    {{ Str::limit($customer->alamat, 30) }}
                </td>
                <td class="px-6 py-4">
                    <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded border border-gray-300">
                        {{ $customer->tariff->kd_tarif }} ({{ $customer->tariff->beban }} VA)
                    </span>
                </td>
                <td class="px-6 py-4 text-center space-x-2">
                    <a href="{{ route('listrik.pelanggan.edit', $customer->id) }}" class="font-medium text-blue-600 hover:underline">Edit</a>

                    <form action="{{ route('listrik.pelanggan.destroy', $customer->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus pelanggan ini? Data tagihan terkait juga akan terhapus.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="font-medium text-red-600 hover:underline">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-4 text-center text-gray-400">
                    Belum ada data pelanggan.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $customers->links() }}
</div>
@endsection
