<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Customer;
use Illuminate\Http\Request;

class BillController extends Controller
{
    /**
     * Menampilkan daftar tagihan.
     */
    public function index()
    {
        // Eager loading 'customer' agar tidak berat saat query
        $bills = Bill::with('customer')->latest()->paginate(10);
        return view('listrik.tagihan.index', compact('bills'));
    }

    /**
     * Form buat tagihan baru.
     */
    public function create()
    {
        // Kita butuh data pelanggan untuk dipilih
        $customers = Customer::all();
        return view('listrik.tagihan.create', compact('customers'));
    }

    /**
     * Simpan tagihan.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'bulan_tagihan' => 'required|integer|min:1|max:12',
            'tahun_tagihan' => 'required|digits:4|integer|min:2000',
            'pemakaian' => 'required|integer|min:0',
        ]);

        // Cek duplikasi tagihan (Pelanggan yang sama di bulan & tahun yang sama)
        $exists = Bill::where('customer_id', $request->customer_id)
                    ->where('bulan_tagihan', $request->bulan_tagihan)
                    ->where('tahun_tagihan', $request->tahun_tagihan)
                    ->exists();

        if ($exists) {
            return back()->withErrors(['customer_id' => 'Tagihan untuk pelanggan ini pada bulan tersebut sudah ada.'])->withInput();
        }

        Bill::create($request->all());

        return redirect()->route('listrik.tagihan.index')
            ->with('success', 'Tagihan berhasil dibuat.');
    }

    /**
     * Form edit tagihan.
     */
    public function edit(Bill $bill) // Gunakan parameter $bill agar sesuai route model binding
    {
        $customers = Customer::all();
        return view('listrik.tagihan.edit', compact('bill', 'customers'));
    }

    /**
     * Update tagihan.
     */
    public function update(Request $request, Bill $bill)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'bulan_tagihan' => 'required|integer|min:1|max:12',
            'tahun_tagihan' => 'required|digits:4|integer',
            'pemakaian' => 'required|integer|min:0',
        ]);

        $bill->update($request->all());

        return redirect()->route('listrik.tagihan.index')
            ->with('success', 'Tagihan berhasil diperbarui.');
    }

    /**
     * Hapus tagihan.
     */
    public function destroy(Bill $bill)
    {
        $bill->delete();
        return redirect()->route('listrik.tagihan.index')
            ->with('success', 'Tagihan berhasil dihapus.');
    }
}
