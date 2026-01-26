@extends('layouts.main')

@section('title', 'Edit Pelanggan')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-bold text-gray-800">Edit Data Pelanggan</h2>
        <a href="{{ route('listrik.pelanggan.index') }}" class="text-sm text-gray-500 hover:text-black">&larr; Kembali</a>
    </div>

    <form action="{{ route('listrik.pelanggan.update', $customer->id) }}" method="POST" class="bg-white p-6 border border-gray-200 rounded-lg shadow-sm">
        @csrf
        @method('PUT')

        <div class="mb-5">
            <label for="nomor_kwh" class="block mb-2 text-sm font-medium text-gray-900">Nomor KWh</label>
            <input type="text" id="nomor_kwh" name="nomor_kwh" value="{{ old('nomor_kwh', $customer->nomor_kwh) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-black focus:border-black block w-full p-2.5" required>
            @error('nomor_kwh') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="mb-5">
            <label for="nama_pelanggan" class="block mb-2 text-sm font-medium text-gray-900">Nama Lengkap</label>
            <input type="text" id="nama_pelanggan" name="nama_pelanggan" value="{{ old('nama_pelanggan', $customer->nama_pelanggan) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-black focus:border-black block w-full p-2.5" required>
            @error('nama_pelanggan') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="mb-5">
            <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900">Alamat</label>
            <textarea id="alamat" name="alamat" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-black focus:border-black block w-full p-2.5" required>{{ old('alamat', $customer->alamat) }}</textarea>
            @error('alamat') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="mb-5">
            <label for="electricity_tariff_id" class="block mb-2 text-sm font-medium text-gray-900">Jenis Tarif</label>
            <select id="electricity_tariff_id" name="electricity_tariff_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-black focus:border-black block w-full p-2.5" required>
                <option value="" disabled>-- Pilih Tarif --</option>
                @foreach($tariffs as $tarif)
                    <option value="{{ $tarif->id }}" {{ old('electricity_tariff_id', $customer->electricity_tariff_id) == $tarif->id ? 'selected' : '' }}>
                        {{ $tarif->kd_tarif }} - {{ $tarif->beban }} VA
                    </option>
                @endforeach
            </select>
            @error('electricity_tariff_id') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="text-white bg-black hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Update Pelanggan</button>
    </form>
</div>
@endsection
