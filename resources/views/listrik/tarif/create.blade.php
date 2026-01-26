@extends('layouts.main')

@section('title', 'Tambah Tarif')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-bold text-gray-800">Tambah Data Tarif</h2>
        <a href="{{ route('listrik.tarif.index') }}" class="text-sm text-gray-500 hover:text-black">&larr; Kembali</a>
    </div>

    <form action="{{ route('listrik.tarif.store') }}" method="POST" class="bg-white p-6 border border-gray-200 rounded-lg shadow-sm">
        @csrf

        <div class="mb-5">
            <label for="kd_tarif" class="block mb-2 text-sm font-medium text-gray-900">Kode Tarif (Contoh: R1, R2)</label>
            <input type="text" id="kd_tarif" name="kd_tarif" value="{{ old('kd_tarif') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-black focus:border-black block w-full p-2.5" placeholder="Masukkan kode..." required maxlength="4">
            @error('kd_tarif') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="mb-5">
            <label for="beban" class="block mb-2 text-sm font-medium text-gray-900">Beban (Watt/VA)</label>
            <input type="number" id="beban" name="beban" value="{{ old('beban') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-black focus:border-black block w-full p-2.5" placeholder="Contoh: 900" required>
            @error('beban') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="mb-5">
            <label for="tarif_per_kwh" class="block mb-2 text-sm font-medium text-gray-900">Tarif per kWh (Rp)</label>
            <input type="number" id="tarif_per_kwh" name="tarif_per_kwh" value="{{ old('tarif_per_kwh') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-black focus:border-black block w-full p-2.5" placeholder="Contoh: 1352" required>
            @error('tarif_per_kwh') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="text-white bg-black hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Simpan Data</button>
    </form>
</div>
@endsection
