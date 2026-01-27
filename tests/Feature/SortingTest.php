<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SortingTest extends TestCase
{
    // Gunakan RefreshDatabase agar database di-reset setiap kali test berjalan
    // Pastikan konfigurasi database testing Anda benar (biasanya pakai sqlite :memory: atau db test khusus)
    // Jika tidak ingin data hilang, bisa hapus baris 'use RefreshDatabase;' ini.
    // use RefreshDatabase;

    /**
     * Skenario 1: Halaman bisa diakses
     */
    public function test_sorting_page_is_accessible()
    {
        $response = $this->get(route('sorting.index'));
        $response->assertStatus(200);
    }

    /**
     * Skenario 2: Logika Bubble Sort & Penyimpanan Database
     */
    /**
     * Skenario 2: Logika Bubble Sort & Penyimpanan Database
     */
    public function test_bubble_sort_logic_and_database_storage()
    {
        // 1. Data Uji (Input String)
        $inputData = [
            'numbers' => '50, 10, 3, 90'
        ];

        // 2. Eksekusi request ke controller
        $response = $this->post(route('sorting.process'), $inputData);

        // 3. Evaluasi Redirect & Pesan Sukses
        $response->assertRedirect();
        $response->assertSessionHas('success');

        // 4. Verifikasi Database (METODE LEBIH ROBUST)
        // Ambil data terakhir yang masuk ke database
        $task = \App\Models\SortingTask::latest()->first();

        // Pastikan data ditemukan
        $this->assertNotNull($task, 'Data sorting tidak tersimpan di database.');

        // Cek isinya (Laravel otomatis mengubah JSON di DB menjadi Array PHP)
        // Ini menghindari masalah spasi/format JSON yang beda-beda tiap database
        $this->assertEquals([50, 10, 3, 90], $task->input_numbers);
        $this->assertEquals([3, 10, 50, 90], $task->sorted_numbers);

        // Cek apakah file path tersimpan
        $this->assertNotEmpty($task->file_path);
    }
    /**
     * Skenario 3: Validasi Input Kosong
     */
    public function test_sorting_requires_input()
    {
        $response = $this->post(route('sorting.process'), ['numbers' => '']);
        $response->assertSessionHasErrors('numbers');
    }
}
