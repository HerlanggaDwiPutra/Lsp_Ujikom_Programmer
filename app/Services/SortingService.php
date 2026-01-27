<?php

namespace App\Services;

use App\Models\SortingTask;
use Illuminate\Support\Facades\Storage;

class SortingService
{
    /**
     * Algoritma Bubble Sort (Sesuai Unit: Pemrograman Terstruktur)
     * Menggunakan Nested Loop dan Swapping.
     */
    public function bubbleSort(array $arr): array
    {
        $n = count($arr);

        // Loop 1: Iterasi seluruh elemen
        for ($i = 0; $i < $n; $i++) {
            // Loop 2: Bandingkan elemen bersebelahan
            for ($j = 0; $j < $n - $i - 1; $j++) {
                // Logika Tukar Data (Swap)
                if ($arr[$j] > $arr[$j + 1]) {
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$j + 1];
                    $arr[$j + 1] = $temp;
                }
            }
        }

        return $arr;
    }

    /**
     * Menyimpan data ke Database dan File .txt
     * (Sesuai Unit: Akses File & Basis Data)
     */
    public function saveSortingData(array $inputData, array $sortedData): void
    {
        // 1. Generate Konten File
        $content = "Input: " . implode(', ', $inputData) . "\n";
        $content .= "Sorted: " . implode(', ', $sortedData) . "\n";
        $content .= "Date: " . now();

        // 2. Simpan File Fisik (.txt)
        $fileName = 'sorting/sort_' . time() . '.txt';
        Storage::disk('public')->put($fileName, $content);

        // 3. Simpan ke Database (Menyimpan path file juga)
        SortingTask::create([
            'input_numbers' => $inputData,
            'sorted_numbers' => $sortedData,
            'file_path' => $fileName // Path file disimpan di DB
        ]);
    }
}
