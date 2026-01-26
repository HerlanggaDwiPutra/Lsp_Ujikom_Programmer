<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\SortingService;
use App\Models\SortingHistory; // Ubah dari TaskValue ke SortingHistory
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 * Class SortingController
 * Controller ini bertugas menerima input dari User, memproses sorting,
 * dan menyimpan ke tabel sorting_histories sesuai Unit Test.
 * * @package App\Http\Controllers
 */
class SortingController extends Controller
{
    /**
     * Constructor Injection.
     * @param SortingService $service
     */
    public function __construct(
        protected SortingService $service
    ) {}

    /**
     * Menampilkan halaman utama dan riwayat data.
     * @return View
     */
    public function index(): View
    {
        // Ambil data terbaru dari tabel sorting_histories
        $history = SortingHistory::latest()->get();
        return view('sorting.index', compact('history'));
    }

    /**
     * Memproses form input angka.
     * @param Request $request Data dari form.
     * @return RedirectResponse Kembali ke halaman sebelumnya.
     */
    public function process(Request $request): RedirectResponse
    {
        // Validasi: Input wajib diisi
        $request->validate([
            'numbers' => 'required|string',
        ]);

        try {
            // 1. Ubah string "10, 20, 5" menjadi array [10, 20, 5]
            $rawInputString = explode(',', $request->input('numbers'));

            // Bersihkan spasi dan ubah jadi integer
            $numbersArray = array_map(function($item) {
                return (int) trim($item);
            }, $rawInputString);

            // 2. Lakukan Sorting (Bisa pakai Service atau native PHP untuk memastikan logic test jalan)
            // Kita gunakan native sort agar array values ter-reset indexnya
            $sortedArray = $numbersArray;
            sort($sortedArray);

            // 3. Simpan ke Database (PENTING: Agar Unit Test 'assertDatabaseHas' berhasil)
            // Model SortingHistory otomatis meng-convert array ke JSON karena casting di Model
            SortingHistory::create([
                'input_numbers' => $numbersArray,
                'sorted_numbers' => $sortedArray
            ]);

            // Opsional: Jika Anda ingin tetap membuat file fisik via Service, uncomment baris bawah:
            // $this->service->saveRecord($numbersArray, $sortedArray);

            // Balik ke halaman dengan pesan sukses
            return redirect()->back()->with('success', 'Data berhasil diurutkan dan disimpan!');

        } catch (\Exception $e) {
            // Debugging: Catat error di Log file
            Log::error('Controller Error: ' . $e->getMessage());

            return redirect()->back()
                ->withErrors(['msg' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    /**
     * Route untuk download file .txt (Generate on the fly)
     * @param int $id ID dari data di database.
     * @return mixed File download atau error.
     */
    public function download(int $id)
    {
        try {
            // Cari data di SortingHistory
            $data = SortingHistory::findOrFail($id);

            // Buat konten file secara dinamis
            $content = "Input Awal: " . implode(', ', $data->input_numbers) . "\n";
            $content .= "Hasil Sorting: " . implode(', ', $data->sorted_numbers);

            $fileName = 'sorting_result_' . $data->id . '.txt';

            // Return response download stream
            return response()->streamDownload(function () use ($content) {
                echo $content;
            }, $fileName);

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['msg' => 'File tidak ditemukan.']);
        }
    }
}
