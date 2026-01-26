@extends('layouts.main')

@section('title', 'Data Tagihan')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Data Tagihan Listrik</h2>
    <a href="{{ route('listrik.tagihan.create') }}" class="bg-black text-white px-4 py-2 rounded hover:bg-gray-800 transition shadow-sm text-sm font-medium">
        + Buat Tagihan
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
                <th scope="col" class="px-6 py-3">Pelanggan</th>
                <th scope="col" class="px-6 py-3">Periode</th>
                <th scope="col" class="px-6 py-3">Pemakaian (Meter)</th>
                <th scope="col" class="px-6 py-3 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bills as $bill)
            <tr class="bg-white border-b hover:bg-gray-50">
                <td class="px-6 py-4 font-medium text-gray-900">
                    {{ $bill->customer->nama_pelanggan }} <br>
                    <span class="text-xs text-gray-400">ID: {{ $bill->customer->nomor_kwh }}</span>
                </td>
                <td class="px-6 py-4">
                    {{ \Carbon\Carbon::createFromDate(null, $bill->bulan_tagihan)->translatedFormat('F') }} {{ $bill->tahun_tagihan }}
                </td>
                <td class="px-6 py-4">
                    {{ $bill->pemakaian }} Meter
                </td>
                <td class="px-6 py-4 text-center space-x-2">
                    <a href="{{ route('listrik.tagihan.edit', $bill->id) }}" class="font-medium text-blue-600 hover:underline">Edit</a>

                    <form action="{{ route('listrik.tagihan.destroy', $bill->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus tagihan ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="font-medium text-red-600 hover:underline">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="px-6 py-4 text-center text-gray-400">
                    Belum ada data tagihan.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $bills->links() }}
</div>
@endsection
