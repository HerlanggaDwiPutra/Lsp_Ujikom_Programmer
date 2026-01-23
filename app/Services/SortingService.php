<?php

declare(strict_types=1); // Memastikan tipe data harus sesuai (Best Practice)

namespace App\Services;

use App\Models\TaskValue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Class SortingService
 * Service ini berisi logika untuk mengurutkan angka, menyimpan data,
 * dan menangani file download.
 * * @package App\Services
 * @author  [Herlangga]
 */
class SortingService
{
    /**
     * Mengurutkan angka dari kecil ke besar (Ascending) menggunakan Bubble Sort.
     * * @param array $numbers  Daftar angka yang belum urut.
     * @return array          Daftar angka yang sudah diurutkan.
     */
    public function sortNumbers(array $numbers): array
    {
        // Debugging: Mencatat data sebelum diolah
        Log::info('Service: Mulai proses sorting.', ['input' => $numbers]);

        $jumlahData = count($numbers);

        // Algoritma Pengurutan (Bubble Sort)
        for ($i = 0; $i < $jumlahData - 1; $i++) {
            for ($j = 0; $j < $jumlahData - $i - 1; $j++) {
                // Jika angka kiri lebih besar dari angka kanan, tukar posisi
                if ($numbers[$j] > $numbers[$j + 1]) {
                    $this->swap($numbers, $j, $j + 1);
                }
            }
        }

        return $numbers;
    }

    /**
     * Fungsi pembantu untuk menukar posisi dua angka dalam array.
     * Menggunakan konsep "Pass by Reference" (tanda &).
     * * @param array $array  Array asli yang sedang diubah.
     * @param int   $index1 Posisi data pertama.
     * @param int   $index2 Posisi data kedua.
     * @return void
     */
    private function swap(array &$array, int $index1, int $index2): void
    {
        $temp = $array[$index1];        // Simpan data 1 ke variabel sementara
        $array[$index1] = $array[$index2]; // Pindahkan data 2 ke posisi 1
        $array[$index2] = $temp;        // Pindahkan data sementara ke posisi 2
    }

    /**
     * Menyimpan hasil ke Database dan membuat File .txt fisik.
     * * @param array $raw     Data angka input.
     * @param array $sorted  Data angka hasil urut.
     * @return TaskValue     Objek model yang berhasil disimpan.
     * @throws \Exception    Jika gagal membuat file atau simpan DB.
     */
    public function saveRecord(array $raw, array $sorted): TaskValue
    {
        try {
            // 1. Siapkan isi text file
            $content = "HASIL PENGURUTAN\n";
            $content .= "Tanggal: " . now()->toDateTimeString() . "\n";
            $content .= "Input: " . implode(', ', $raw) . "\n";
            $content .= "Output: " . implode(', ', $sorted);

            // 2. Tentukan nama file unik
            $fileName = 'hasil_urut_' . time() . '.txt';
            $filePath = "downloads/{$fileName}";

            // 3. Simpan file ke folder storage/app/public/downloads
            Storage::disk('public')->put($filePath, $content);

            // Debugging: Catat sukses simpan file
            Log::info("Service: File berhasil disimpan di {$filePath}");

            // 4. Simpan ke Database
            return TaskValue::create([
                'session_name' => 'Sesi ' . now()->format('d M Y H:i'),
                'input_numbers' => $raw,
                'sorted_numbers' => $sorted,
                'file_path' => $filePath
            ]);

        } catch (\Exception $e) {
            // Debugging: Catat jika ada error
            Log::error("Service Error: Gagal menyimpan data. " . $e->getMessage());
            throw $e; // Lempar error agar bisa ditangkap Controller
        }
    }

    /**
     * Mendapatkan file untuk didownload browser.
     * * @param string $path Lokasi file relatif.
     * @return BinaryFileResponse Objek respons download.
     */
    public function downloadFile(string $path): BinaryFileResponse
    {
        // Cek apakah file ada
        if (!Storage::disk('public')->exists($path)) {
            Log::warning("Service: File tidak ditemukan saat mau didownload: {$path}");
            abort(404, 'File tidak ditemukan di server.');
        }

        // Ambil path lengkap (Absolute Path) untuk download
        $fullPath = storage_path("app/public/{$path}");

        return response()->download($fullPath);
    }
}
