<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\ElectricityTariff;
use Illuminate\Http\Request;

/**
 * Class CustomerController
 * Mengelola data Pelanggan Listrik.
 * Relasi: Pelanggan memilih satu Tarif.
 */
class CustomerController extends Controller
{
    /**
     * Menampilkan daftar pelanggan.
     */
    public function index()
    {
        // Eager Loading 'tariff' untuk mencegah N+1 Problem (Best Practice Performance)
        $customers = Customer::with('tariff')->latest()->paginate(10);
        return view('listrik.pelanggan.index', compact('customers'));
    }

    /**
     * Menampilkan form tambah pelanggan.
     */
    public function create()
    {
        // Kita butuh data tarif untuk dropdown pilihan
        $tariffs = ElectricityTariff::all();
        return view('listrik.pelanggan.create', compact('tariffs'));
    }

    /**
     * Menyimpan data pelanggan baru.
     */
    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'nomor_kwh' => 'required|string|unique:customers,nomor_kwh',
            'nama_pelanggan' => 'required|string|max:50',
            'alamat' => 'required|string',
            'electricity_tariff_id' => 'required|exists:electricity_tariffs,id',
        ], [
            'electricity_tariff_id.required' => 'Jenis tarif listrik harus dipilih.'
        ]);

        Customer::create($request->all());

        return redirect()->route('listrik.pelanggan.index')
            ->with('success', 'Pelanggan berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit pelanggan.
     */
    public function edit(Customer $customer) // Ubah parameter jadi $customer (Model Binding)
    {
        $tariffs = ElectricityTariff::all();
        return view('listrik.pelanggan.edit', compact('customer', 'tariffs'));
    }

    /**
     * Update data pelanggan.
     */
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'nomor_kwh' => 'required|string|unique:customers,nomor_kwh,' . $customer->id,
            'nama_pelanggan' => 'required|string|max:50',
            'alamat' => 'required|string',
            'electricity_tariff_id' => 'required|exists:electricity_tariffs,id',
        ]);

        $customer->update($request->all());

        return redirect()->route('listrik.pelanggan.index')
            ->with('success', 'Data pelanggan diperbarui.');
    }

    /**
     * Hapus pelanggan.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('listrik.pelanggan.index')
            ->with('success', 'Data pelanggan dihapus.');
    }
}
