<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\SortingService;
use App\Models\TaskValue;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

/**
 * Class SortingController
 * Controller ini bertugas menerima input dari User dan memanggil Service.
 * Tidak ada logika bisnis yang rumit di sini (Clean Code).
 * * @package App\Http\Controllers
 */
class SortingController extends Controller
{
    /**
     * Constructor Injection.
     * Laravel otomatis memasukkan SortingService ke sini.
     * * @param SortingService $service
     */
    public function __construct(
        protected SortingService $service
    ) {}

    /**
     * Menampilkan halaman utama dan riwayat data.
     * * @return View
     */
    public function index(): View
    {
        // Ambil data terbaru dari database
        $history = TaskValue::latest()->get();
        return view('sorting.index', compact('history'));
    }

    /**
     * Memproses form input angka.
     * * @param Request $request Data dari form.
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
            // explode: memecah string berdasarkan koma
            $rawInputString = explode(',', $request->input('numbers'));

            // array_map: membersihkan spasi dan ubah jadi angka (integer)
            $numbersArray = array_map(function($item) {
                return (int) trim($item);
            }, $rawInputString);

            // 2. Panggil Service untuk mengurutkan
            $sortedArray = $this->service->sortNumbers($numbersArray);

            // 3. Panggil Service untuk simpan ke DB dan File
            $this->service->saveRecord($numbersArray, $sortedArray);

            // Balik ke halaman dengan pesan sukses
            return redirect()->back()->with('success', 'Data berhasil diurutkan!');

        } catch (\Exception $e) {
            // Debugging: Catat error di Log file
            Log::error('Controller Error: ' . $e->getMessage());

            return redirect()->back()
                ->withErrors(['msg' => 'Terjadi kesalahan. Cek log sistem.']);
        }
    }

    /**
     * Route untuk download file .txt
     * * @param int $id ID dari data di database.
     * @return mixed File download atau error.
     */
    public function download(int $id)
    {
        // Cari data berdasarkan ID, jika tidak ada tampilkan 404
        $data = TaskValue::findOrFail($id);

        // Panggil fungsi download di service
        return $this->service->downloadFile($data->file_path);
    }
}
