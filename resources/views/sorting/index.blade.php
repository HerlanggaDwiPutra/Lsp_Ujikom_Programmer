<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uji Kompetensi - Sorting Angka</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans p-6">

    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 border-b pb-4">
            Program Pengurutan Angka (Ascending)
        </h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                <strong>Berhasil!</strong> {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <strong>Error:</strong> {{ $errors->first() }}
            </div>
        @endif

        <div class="mb-8 bg-blue-50 p-6 rounded-lg border border-blue-200">
            <form action="{{ route('sorting.process') }}" method="POST">
                @csrf <label class="block text-gray-700 text-sm font-bold mb-2">
                    1. Masukkan Angka (Pisahkan dengan koma)
                </label>

                <input type="text" name="numbers" required
                       placeholder="Contoh: 70, 50, 90, 12, 35"
                       class="shadow appearance-none border rounded w-full py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:border-blue-300">

                <p class="text-sm text-gray-500 mt-2 mb-4">
                    * Masukkan jumlah angka bebas, sistem akan menghitungnya otomatis.
                </p>

                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline transition">
                    2. Urutkan & Simpan
                </button>
            </form>
        </div>

        <h2 class="text-xl font-bold text-gray-800 mb-4">3. Riwayat Hasil Pengurutan</h2>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Waktu</th>
                        <th class="py-3 px-6 text-left">Input Awal</th>
                        <th class="py-3 px-6 text-left">Hasil Sorting</th>
                        <th class="py-3 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @forelse($history as $item)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                {{ $item->created_at->format('d M Y H:i') }}
                            </td>
                            <td class="py-3 px-6 text-left">
                                <span class="bg-red-100 text-red-600 py-1 px-3 rounded-full text-xs">
                                    {{ implode(', ', $item->input_numbers) }}
                                </span>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <span class="bg-green-100 text-green-600 py-1 px-3 rounded-full text-xs font-bold">
                                    {{ implode(', ', $item->sorted_numbers) }}
                                </span>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <a href="{{ route('sorting.download', $item->id) }}"
                                   class="bg-indigo-500 text-white py-1 px-3 rounded text-xs hover:bg-indigo-600">
                                   Download .txt
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-3 px-6 text-center">Belum ada data pengurutan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
