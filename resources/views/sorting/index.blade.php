@extends('layouts.main')

@section('title', 'Program Sorting')

@section('content')
<div class="max-w-4xl mx-auto">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-gray-800">
            Pengurutan Angka <span class="text-sm font-normal text-gray-500">(Ascending)</span>
        </h1>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 shadow-sm">
            <strong>Berhasil!</strong> {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 shadow-sm">
            <strong>Error:</strong> {{ $errors->first() }}
        </div>
    @endif

    <div class="mb-8 bg-white p-6 rounded-lg border border-gray-200 shadow-sm">
        <form action="{{ route('sorting.process') }}" method="POST">
            @csrf
            <label class="block text-gray-700 text-sm font-bold mb-2">
                1. Masukkan Angka (Pisahkan dengan koma)
            </label>

            <input type="text" name="numbers" required
                    placeholder="Contoh: 70, 50, 90, 12, 35"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-black focus:border-black block w-full p-2.5">

            <p class="text-xs text-gray-500 mt-2 mb-4">
                * Sistem akan otomatis memisahkan angka dan mengurutkannya dari kecil ke besar.
            </p>

            <button type="submit"
                    class="text-white bg-black hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition">
                Urutkan & Simpan
            </button>
        </form>
    </div>

    <h2 class="text-xl font-bold text-gray-800 mb-4">Riwayat Pengurutan</h2>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg border border-gray-200">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
                <tr>
                    <th scope="col" class="px-6 py-3">Waktu</th>
                    <th scope="col" class="px-6 py-3">Input Awal</th>
                    <th scope="col" class="px-6 py-3">Hasil Sorting</th>
                    <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($history as $item)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $item->created_at->format('d M Y H:i') }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded border border-red-200">
                                {{ implode(', ', $item->input_numbers) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded border border-green-200">
                                {{ implode(', ', $item->sorted_numbers) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('sorting.download', $item->id) }}"
                               class="font-medium text-blue-600 hover:underline">
                                Download .txt
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-400">Belum ada data pengurutan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
