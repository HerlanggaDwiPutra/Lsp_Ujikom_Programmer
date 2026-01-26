<?php

namespace App\Http\Controllers;

use App\Models\ElectricityTariff;
use App\Http\Requests\StoreTariffRequest;
use App\Http\Requests\UpdateTariffRequest; // Pastikan dibuat
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class ElectricityTariffController
 * * Mengelola data master Tarif Listrik (tbTarifListrik).
 * Sesuai Unit Kompetensi J.620100.021.02 (Menerapkan Akses Basis Data).
 *
 * @package App\Http\Controllers
 * @author  Errico Bagus
 */
class ElectricityTariffController extends Controller
{
    /**
     * Menampilkan daftar semua tarif listrik.
     * Menggunakan pagination untuk efisiensi resource (Best Practice).
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Mengambil data urut berdasarkan yang terbaru
        $tariffs = ElectricityTariff::latest()->paginate(10);

        return view('listrik.tarif.index', compact('tariffs'));
    }

    /**
     * Menampilkan form untuk membuat tarif baru.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('listrik.tarif.create');
    }

    /**
     * Menyimpan data tarif baru ke database.
     * * @param StoreTariffRequest $request Validasi input otomatis
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreTariffRequest $request)
    {
        // Implementasi OOP: Menggunakan Mass Assignment
        ElectricityTariff::create([
            'user_id' => Auth::id() ?? 1, // Fallback ke user 1 jika belum login (untuk testing)
            'kd_tarif' => $request->kd_tarif,
            'beban' => $request->beban,
            'tarif_per_kwh' => $request->tarif_per_kwh,
        ]);

        return redirect()->route('listrik.tarif.index')
            ->with('success', 'Data Tarif berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit tarif.
     *
     * @param ElectricityTariff $electricityTariff Model binding
     * @return \Illuminate\View\View
     */
    public function edit(ElectricityTariff $electricityTariff)
    {
        return view('listrik.tarif.edit', compact('electricityTariff'));
    }

    /**
     * Memperbarui data tarif di database.
     *
     * @param Request $request
     * @param ElectricityTariff $electricityTariff
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, ElectricityTariff $electricityTariff)
    {
        // Validasi manual sederhana jika belum membuat UpdateTariffRequest
        $validated = $request->validate([
            'kd_tarif' => 'required|string|max:4|unique:electricity_tariffs,kd_tarif,' . $electricityTariff->id,
            'beban' => 'required|integer',
            'tarif_per_kwh' => 'required|numeric',
        ]);

        $electricityTariff->update($validated);

        return redirect()->route('listrik.tarif.index')
            ->with('success', 'Data Tarif berhasil diperbarui.');
    }

    /**
     * Menghapus data tarif dari database.
     *
     * @param ElectricityTariff $electricityTariff
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(ElectricityTariff $electricityTariff)
    {
        // Cek relasi sebelum hapus (Integrity Constraint)
        if ($electricityTariff->customers()->count() > 0) {
            return back()->with('error', 'Gagal hapus! Tarif ini sedang digunakan oleh Pelanggan.');
        }

        $electricityTariff->delete();

        return redirect()->route('listrik.tarif.index')
            ->with('success', 'Data Tarif berhasil dihapus.');
    }
}
