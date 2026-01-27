@extends('layouts.main')

@section('title', 'Bubble Sort Program')

@section('content')
<div class="max-w-4xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Program Bubble Sort & File Storage</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">{{ session('success') }}</div>
    @endif

    <form action="{{ route('sorting.process') }}" method="POST" class="bg-white p-6 rounded shadow mb-6">
        @csrf
        <label class="block mb-2 font-bold">Masukkan Angka (pisahkan koma):</label>
        <input type="text" name="numbers" placeholder="Contoh: 50, 10, 3, 90" class="border p-2 w-full rounded mb-4" required>
        <button type="submit" class="bg-black text-white px-4 py-2 rounded">Urutkan (Bubble Sort)</button>
    </form>

    <h2 class="text-xl font-bold mb-2">Riwayat</h2>
    <table class="w-full border bg-white">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2 border">Waktu</th>
                <th class="p-2 border">Input</th>
                <th class="p-2 border">Hasil (Bubble Sort)</th>
                <th class="p-2 border">File</th>
            </tr>
        </thead>
        <tbody>
            @foreach($history as $item)
            <tr>
                <td class="p-2 border">{{ $item->created_at->format('d M Y H:i') }}</td>
                <td class="p-2 border">{{ implode(', ', $item->input_numbers) }}</td>
                <td class="p-2 border font-bold text-green-600">{{ implode(', ', $item->sorted_numbers) }}</td>
                <td class="p-2 border text-center">
                    <a href="{{ route('sorting.download', $item->id) }}" class="text-blue-600 underline">Download .txt</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
