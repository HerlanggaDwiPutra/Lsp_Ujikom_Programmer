@extends('layouts.main')

@section('title', 'Buat Tagihan')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-bold text-gray-800">Input Tagihan Baru</h2>
        <a href="{{ route('listrik.tagihan.index') }}" class="text-sm text-gray-500 hover:text-black">&larr; Kembali</a>
    </div>

    <form action="{{ route('listrik.tagihan.store') }}" method="POST" class="bg-white p-6 border border-gray-200 rounded-lg shadow-sm">
        @csrf

        <div class="mb-5">
            <label for="customer_id" class="block mb-2 text-sm font-medium text-gray-900">Nama Pelanggan</label>
            <select id="customer_id" name="customer_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-black focus:border-black block w-full p-2.5" required>
                <option value="" selected disabled>-- Pilih Pelanggan --</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                        {{ $customer->nama_pelanggan }} ({{ $customer->nomor_kwh }})
                    </option>
                @endforeach
            </select>
            @error('customer_id') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div class="mb-5">
                <label for="bulan_tagihan" class="block mb-2 text-sm font-medium text-gray-900">Bulan</label>
                <select id="bulan_tagihan" name="bulan_tagihan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-black focus:border-black block w-full p-2.5" required>
                    @foreach(range(1, 12) as $m)
                        <option value="{{ $m }}" {{ old('bulan_tagihan', date('n')) == $m ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::createFromDate(null, $m)->translatedFormat('F') }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-5">
                <label for="tahun_tagihan" class="block mb-2 text-sm font-medium text-gray-900">Tahun</label>
                <input type="number" id="tahun_tagihan" name="tahun_tagihan" value="{{ old('tahun_tagihan', date('Y')) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-black focus:border-black block w-full p-2.5" required>
                @error('tahun_tagihan') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="mb-5">
            <label for="pemakaian" class="block mb-2 text-sm font-medium text-gray-900">Jumlah Pemakaian (Meter)</label>
            <input type="number" id="pemakaian" name="pemakaian" value="{{ old('pemakaian') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-black focus:border-black block w-full p-2.5" placeholder="Contoh: 150" required>
            @error('pemakaian') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="text-white bg-black hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Simpan Tagihan</button>
    </form>
</div>
@endsection
