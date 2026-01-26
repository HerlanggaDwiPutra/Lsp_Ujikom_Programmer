<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penggajian - PT Argo Industri</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-2xl bg-white border border-gray-200 shadow-xl rounded-2xl overflow-hidden">

        <div class="bg-black text-white p-8 text-center">
            <h1 class="text-3xl font-bold tracking-wider uppercase">PT Argo Industri</h1>
            <p class="text-gray-400 text-sm mt-2">Sistem Hitung Gaji & Cetak Slip</p>
        </div>

        <div class="p-8">
            @if($errors->any())
                <div class="mb-6 p-4 bg-gray-100 border-l-4 border-black text-sm">
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
                            class="w-full border-b-2 border-gray-300 bg-transparent py-2 focus:border-black focus:outline-none transition-colors">
                        <option value="" selected disabled>-- Pilih Nama Pegawai --</option>
                        @foreach($employees as $emp)
                            <option value="{{ $emp->id }}" data-role="{{ $emp->role }}">
                                {{ $emp->nip }} - {{ $emp->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div id="dynamicInputs" class="bg-gray-50 p-6 rounded-lg border border-gray-100 hidden">
                    <h3 class="text-sm font-bold text-gray-400 uppercase mb-4 border-b pb-2">Input Variabel Gaji</h3>

                    <div id="input-satpam" class="role-input hidden">
                        <label class="block text-sm font-medium mb-1">Total Jam Lembur</label>
                        <input type="number" name="overtime_hours" placeholder="Contoh: 10"
                               class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-gray-200 focus:outline-none">
                        <p class="text-xs text-gray-500 mt-1">*Tarif lembur: Rp 20.000 / jam</p>
                    </div>

                    <div id="input-sales" class="role-input hidden">
                        <label class="block text-sm font-medium mb-1">Jumlah Pelanggan yang Didapat</label>
                        <input type="number" name="total_customers" placeholder="Contoh: 50"
                               class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-gray-200 focus:outline-none">
                        <p class="text-xs text-gray-500 mt-1">*Komisi: Rp 50.000 / pelanggan</p>
                    </div>

                    <div id="input-manager" class="role-input hidden">
                        <label class="block text-sm font-medium mb-1">Persentase Peningkatan Penjualan (%)</label>
                        <input type="number" step="0.1" name="sales_growth_percentage" placeholder="Contoh: 12.5"
                               class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-gray-200 focus:outline-none">
                        <p class="text-xs text-gray-500 mt-1">*Bonus diberikan jika > 1%</p>
                    </div>

                    <div id="input-admin" class="role-input hidden">
                        <p class="text-sm text-gray-600 italic">
                            Untuk staf Administrasi, tunjangan dihitung otomatis berdasarkan
                            <span class="font-bold">Lama Bekerja</span> (Tanggal Masuk). Tidak ada input tambahan.
                        </p>
                    </div>
                </div>

                <button type="submit"
                        class="w-full bg-black text-white font-bold py-4 rounded-lg hover:bg-gray-800 transition transform hover:-translate-y-1 shadow-lg">
                    HITUNG & CETAK SLIP GAJI
                </button>
            </form>
        </div>

        <div class="bg-gray-100 p-4 text-center text-xs text-gray-500">
            &copy; {{ date('Y') }} PT Argo Industri. All Rights Reserved.
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
</body>
</html>
