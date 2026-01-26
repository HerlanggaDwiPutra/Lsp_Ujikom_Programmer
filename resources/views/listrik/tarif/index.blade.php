@extends('layouts.main')

@section('title', 'Data Tarif Listrik')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Manajemen Tarif Listrik</h2>
    <a href="{{ route('listrik.tarif.create') }}" class="bg-black text-white px-4 py-2 rounded hover:bg-gray-800 transition shadow-sm text-sm font-medium">
        + Tambah Tarif
    </a>
</div>

@if(session('success'))
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 border border-green-200" role="alert">
        <span class="font-medium">Berhasil!</span> {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 border border-red-200" role="alert">
        <span class="font-medium">Gagal!</span> {{ session('error') }}
    </div>
@endif

<div class="relative overflow-x-auto shadow-md sm:rounded-lg border border-gray-200">
    <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
            <tr>
                <th scope="col" class="px-6 py-3">Kode Tarif</th>
                <th scope="col" class="px-6 py-3">Beban (VA)</th>
                <th scope="col" class="px-6 py-3">Tarif / kWh</th>
                <th scope="col" class="px-6 py-3 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tariffs as $tarif)
            <tr class="bg-white border-b hover:bg-gray-50">
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    {{ $tarif->kd_tarif }}
                </td>
                <td class="px-6 py-4">
                    {{ number_format($tarif->beban) }} VA
                </td>
                <td class="px-6 py-4">
                    Rp {{ number_format($tarif->tarif_per_kwh, 0, ',', '.') }}
                </td>
                <td class="px-6 py-4 text-center space-x-2">
                    <a href="{{ route('listrik.tarif.edit', $tarif->id) }}" class="font-medium text-blue-600 hover:underline">Edit</a>

                    <form action="{{ route('listrik.tarif.destroy', $tarif->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus tarif ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="font-medium text-red-600 hover:underline">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="px-6 py-4 text-center text-gray-400">
                    Belum ada data tarif. Silakan tambah data.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $tariffs->links() }}
</div>
@endsection
