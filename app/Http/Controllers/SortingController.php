<?php

namespace App\Http\Controllers;

use App\Models\SortingTask;
use App\Services\SortingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Pastikan ini di-import

class SortingController extends Controller
{
    // Dependency Injection Service
    public function __construct(
        protected SortingService $service
    ) {}

    /**
     * Menampilkan halaman utama dan riwayat.
     */
    public function index()
    {
        $history = SortingTask::latest()->get();
        return view('sorting.index', compact('history'));
    }

    /**
     * Memproses sorting dan penyimpanan.
     */
    public function process(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'numbers' => 'required|string'
        ]);

        try {
            // 2. Parsing Input (String "5,1,3" -> Array [5,1,3])
            $inputString = explode(',', $request->numbers);

            // Bersihkan spasi dan pastikan angka
            $inputArray = array_map(fn($val) => (int) trim($val), $inputString);

            // 3. Panggil Bubble Sort dari Service
            $sortedArray = $this->service->bubbleSort($inputArray);

            // 4. Simpan Data & File via Service
            $this->service->saveSortingData($inputArray, $sortedArray);

            return back()->with('success', 'Data berhasil diurutkan (Bubble Sort) dan disimpan!');

        } catch (\Exception $e) {
            return back()->withErrors(['msg' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    /**
     * Method untuk download file .txt
     * Method ini yang sebelumnya error "undefined"
     */
    public function download($id)
    {
        // Cari data berdasarkan ID
        $task = SortingTask::findOrFail($id);

        // Cek apakah file fisik ada di storage
        if (Storage::disk('public')->exists($task->file_path)) {
            // Lakukan download
            $fullPath = Storage::disk('public')->path($task->file_path);
            return response()->download($fullPath);
        }

        return back()->withErrors('File fisik tidak ditemukan di server.');
    }
}
