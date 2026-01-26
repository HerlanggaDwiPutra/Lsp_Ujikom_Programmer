<?php

namespace Tests\Feature;

use Tests\TestCase;

class SortingTest extends TestCase
{
    /** * Skenario 1: Halaman bisa diakses
     */
    public function test_sorting_page_is_accessible()
    {
        $response = $this->get(route('sorting.index'));
        $response->assertStatus(200);
    }

    /** * Skenario 2: Input angka acak berhasil diurutkan (Logic Test)
     */
    /** * Skenario 2: Input angka acak berhasil diurutkan (Logic Test)
     */
    public function test_sorting_logic_works_correctly()
    {
        // 1. Siapkan Data Uji (Prepare Test Data)
        $inputData = [
            'numbers' => '70, 50, 90, 10'
        ];

        // 2. Eksekusi (Execute)
        $response = $this->post(route('sorting.process'), $inputData);

        // 3. Evaluasi Hasil (Evaluate)
        $response->assertRedirect();
        $response->assertSessionHas('success');

        // PERBAIKAN DI SINI:
        // Gunakan integer (70), bukan string ('70') agar cocok dengan Controller
        $this->assertDatabaseHas('sorting_histories', [
            'input_numbers' => json_encode([70, 50, 90, 10]),
            'sorted_numbers' => json_encode([10, 50, 70, 90])
        ]);
    }

    /** * Skenario 3: Validasi Input Kosong
     */
    public function test_sorting_requires_input()
    {
        $response = $this->post(route('sorting.process'), ['numbers' => '']);
        $response->assertSessionHasErrors('numbers');
    }
}
