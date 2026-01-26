@extends('layouts.main')

@section('title', 'Sistem Penggajian')

@section('content')
<div class="max-w-3xl mx-auto">

    <div class="bg-white border border-gray-200 shadow-sm rounded-2xl overflow-hidden">

        <div class="bg-black text-white p-6 text-center">
            <h1 class="text-2xl font-bold tracking-wider uppercase">PT Argo Industri</h1>
            <p class="text-gray-400 text-sm mt-1">Sistem Hitung Gaji & Cetak Slip</p>
        </div>

        <div class="p-8">
            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-sm text-red-700">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('payroll.calculate') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-sm font-semibold text-gray-700 uppercase mb-2">Pilih Pegawai</label>
                    <select name="employee_id" id="employeeSelect" onchange="toggleInputs()"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-black focus:border-black block w-full p-2.5">
                        <option value="" selected disabled>-- Pilih Nama Pegawai --</option>
                        @foreach($employees as $emp)
                            <option value="{{ $emp->id }}" data-role="{{ $emp->role }}">
                                {{ $emp->nip }} - {{ $emp->name }} ({{ ucfirst($emp->role) }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div id="dynamicInputs" class="bg-gray-50 p-6 rounded-lg border border-gray-200 hidden">
                    <h3 class="text-sm font-bold text-gray-500 uppercase mb-4 border-b pb-2">Input Variabel Gaji</h3>

                    <div id="input-satpam" class="role-input hidden">
                        <label class="block text-sm font-medium mb-1">Total Jam Lembur</label>
                        <input type="number" name="overtime_hours" placeholder="Contoh: 10"
                               class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-black focus:border-black block w-full p-2.5">
                        <p class="text-xs text-gray-500 mt-1">*Tarif lembur: Rp 20.000 / jam</p>
                    </div>

                    <div id="input-sales" class="role-input hidden">
                        <label class="block text-sm font-medium mb-1">Jumlah Pelanggan yang Didapat</label>
                        <input type="number" name="total_customers" placeholder="Contoh: 50"
                               class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-black focus:border-black block w-full p-2.5">
                        <p class="text-xs text-gray-500 mt-1">*Komisi: Rp 50.000 / pelanggan</p>
                    </div>

                    <div id="input-manager" class="role-input hidden">
                        <label class="block text-sm font-medium mb-1">Persentase Peningkatan Penjualan (%)</label>
                        <input type="number" step="0.1" name="sales_growth_percentage" placeholder="Contoh: 12.5"
                               class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-black focus:border-black block w-full p-2.5">
                        <p class="text-xs text-gray-500 mt-1">*Bonus diberikan jika > 1%</p>
                    </div>

                    <div id="input-admin" class="role-input hidden">
                        <div class="flex items-center p-4 mb-4 text-sm text-blue-800 border border-blue-300 rounded-lg bg-blue-50" role="alert">
                            <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                            </svg>
                            <div>
                                <span class="font-medium">Info Administrasi:</span> Tunjangan dihitung otomatis berdasarkan tanggal masuk kerja.
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit"
                        class="w-full text-white bg-black hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-3 text-center shadow-lg transition-transform transform hover:-translate-y-0.5">
                    HITUNG & CETAK SLIP GAJI
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function toggleInputs() {
        const select = document.getElementById('employeeSelect');
        const selectedOption = select.options[select.selectedIndex];
        const role = selectedOption.getAttribute('data-role');

        // Container Input
        const container = document.getElementById('dynamicInputs');
        const allInputs = document.querySelectorAll('.role-input');

        // Reset semua input (sembunyikan)
        allInputs.forEach(el => el.classList.add('hidden'));

        // Tampilkan container jika ada role yang dipilih
        if(role) {
            container.classList.remove('hidden');

            // Tampilkan input spesifik
            const targetInput = document.getElementById(`input-${role}`);
            if(targetInput) {
                targetInput.classList.remove('hidden');
            }
        } else {
            container.classList.add('hidden');
        }
    }
</script>
@endsection
