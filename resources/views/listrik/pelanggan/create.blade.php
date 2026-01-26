@extends('layouts.main')

@section('title', 'Tambah Pelanggan')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-bold text-gray-800">Registrasi Pelanggan Baru</h2>
        <a href="{{ route('listrik.pelanggan.index') }}" class="text-sm text-gray-500 hover:text-black">&larr; Kembali</a>
    </div>

    <form action="{{ route('listrik.pelanggan.store') }}" method="POST" class="bg-white p-6 border border-gray-200 rounded-lg shadow-sm">
        @csrf

        <div class="mb-5">
            <label for="nomor_kwh" class="block mb-2 text-sm font-medium text-gray-900">Nomor KWh / ID Pelanggan</label>
            <input type="text" id="nomor_kwh" name="nomor_kwh" value="{{ old('nomor_kwh') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-black focus:border-black block w-full p-2.5" placeholder="Contoh: 1300998877" required>
            @error('nomor_kwh') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="mb-5">
            <label for="nama_pelanggan" class="block mb-2 text-sm font-medium text-gray-900">Nama Lengkap</label>
            <input type="text" id="nama_pelanggan" name="nama_pelanggan" value="{{ old('nama_pelanggan') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-black focus:border-black block w-full p-2.5" placeholder="Nama sesuai KTP" required>
            @error('nama_pelanggan') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="mb-5">
            <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900">Alamat Lengkap</label>
            <textarea id="alamat" name="alamat" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-black focus:border-black block w-full p-2.5" placeholder="Alamat domisili pelanggan..." required>{{ old('alamat') }}</textarea>
            @error('alamat') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="mb-5">
            <label for="electricity_tariff_id" class="block mb-2 text-sm font-medium text-gray-900">Jenis Tarif / Daya</label>
            <select id="electricity_tariff_id" name="electricity_tariff_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-black focus:border-black block w-full p-2.5" required>
                <option value="" selected disabled>-- Pilih Daya Listrik --</option>
                @foreach($tariffs as $tarif)
                    <option value="{{ $tarif->id }}" {{ old('electricity_tariff_id') == $tarif->id ? 'selected' : '' }}>
                        {{ $tarif->kd_tarif }} - {{ $tarif->beban }} VA (Rp {{ number_format($tarif->tarif_per_kwh) }}/kWh)
                    </option>
                @endforeach
            </select>
            @error('electricity_tariff_id') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror

            @if($tariffs->isEmpty())
                <p class="mt-2 text-xs text-red-500">* Belum ada data tarif. Silakan tambah data tarif terlebih dahulu.</p>
            @endif
        </div>

        <button type="submit" class="text-white bg-black hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Simpan Pelanggan</button>
    </form>
</div>
@endsection
