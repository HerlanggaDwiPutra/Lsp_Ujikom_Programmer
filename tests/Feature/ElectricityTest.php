<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\ElectricityTariff;
use App\Models\Customer;

class ElectricityTest extends TestCase
{
    // Gunakan trait ini agar database di-reset setiap kali test berjalan (Data bersih)
    use RefreshDatabase;

    /**
     * Setup: Login sebagai Admin sebelum test
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @var \App\Models\User $user */
        $user = User::factory()->create(['id' => 1, 'username' => 'admin']);

        $this->actingAs($user); // Error merah akan hilang
    }

    /**
     * Skenario 1: Tambah Data Tarif (Create)
     */
    public function test_can_create_tariff()
    {
        $data = [
            'kd_tarif' => 'R1',
            'beban' => 900,
            'tarif_per_kwh' => 1352
        ];

        $response = $this->post(route('listrik.tarif.store'), $data);

        $response->assertRedirect(route('listrik.tarif.index'));
        $this->assertDatabaseHas('electricity_tariffs', $data);
    }

    /**
     * Skenario 2: Gagal Tambah Tarif Duplikat (Validation)
     */
    public function test_cannot_create_duplicate_tariff_code()
    {
        // Buat 1 tarif dulu
        ElectricityTariff::create([
            'user_id' => 1,
            'kd_tarif' => 'R1',
            'beban' => 900,
            'tarif_per_kwh' => 1352
        ]);

        // Coba input lagi dengan kode sama 'R1'
        $response = $this->post(route('listrik.tarif.store'), [
            'kd_tarif' => 'R1',
            'beban' => 1300,
            'tarif_per_kwh' => 1500
        ]);

        $response->assertSessionHasErrors('kd_tarif');
    }

    /**
     * Skenario 3: Tambah Pelanggan & Relasi Tarif
     */
    public function test_can_create_customer_linked_to_tariff()
    {
        // 1. Buat Tarif dulu (Parent)
        $tariff = ElectricityTariff::create([
            'user_id' => 1,
            'kd_tarif' => 'B1',
            'beban' => 450,
            'tarif_per_kwh' => 1000
        ]);

        // 2. Input Pelanggan
        $customerData = [
            'electricity_tariff_id' => $tariff->id,
            'nomor_kwh' => '123456789',
            'nama_pelanggan' => 'Uji Coba User',
            'alamat' => 'Jl. Testing No. 1'
        ];

        $response = $this->post(route('listrik.pelanggan.store'), $customerData);

        $this->assertDatabaseHas('customers', ['nomor_kwh' => '123456789']);
    }
}
