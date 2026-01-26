@extends('layouts.main')

@section('title', 'Edit Tagihan')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-bold text-gray-800">Edit Data Tagihan</h2>
        <a href="{{ route('listrik.tagihan.index') }}" class="text-sm text-gray-500 hover:text-black">&larr; Kembali</a>
    </div>

    <form action="{{ route('listrik.tagihan.update', $bill->id) }}" method="POST" class="bg-white p-6 border border-gray-200 rounded-lg shadow-sm">
        @csrf
        @method('PUT')

        <div class="mb-5 p-4 bg-gray-50 rounded-lg border border-gray-100">
            <label class="block mb-1 text-xs font-bold text-gray-500 uppercase">Pelanggan</label>
            <div class="text-sm font-medium text-gray-900">{{ $bill->customer->nama_pelanggan }}</div>
            <div class="text-xs text-gray-500">ID: {{ $bill->customer->nomor_kwh }}</div>
            <input type="hidden" name="customer_id" value="{{ $bill->customer_id }}">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div class="mb-5">
                <label for="bulan_tagihan" class="block mb-2 text-sm font-medium text-gray-900">Bulan</label>
                <select id="bulan_tagihan" name="bulan_tagihan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-black focus:border-black block w-full p-2.5" required>
                    @foreach(range(1, 12) as $m)
                        <option value="{{ $m }}" {{ old('bulan_tagihan', $bill->bulan_tagihan) == $m ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::createFromDate(null, $m)->translatedFormat('F') }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-5">
                <label for="tahun_tagihan" class="block mb-2 text-sm font-medium text-gray-900">Tahun</label>
                <input type="number" id="tahun_tagihan" name="tahun_tagihan" value="{{ old('tahun_tagihan', $bill->tahun_tagihan) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-black focus:border-black block w-full p-2.5" required>
                @error('tahun_tagihan') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="mb-5">
            <label for="pemakaian" class="block mb-2 text-sm font-medium text-gray-900">Jumlah Pemakaian (Meter)</label>
            <input type="number" id="pemakaian" name="pemakaian" value="{{ old('pemakaian', $bill->pemakaian) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-black focus:border-black block w-full p-2.5" required>
            <p class="mt-1 text-xs text-gray-500">*Mengubah pemakaian akan mempengaruhi total tagihan.</p>
            @error('pemakaian') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="text-white bg-black hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Update Tagihan</button>
    </form>
</div>
@endsection
