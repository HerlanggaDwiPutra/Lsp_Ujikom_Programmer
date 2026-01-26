<!DOCTYPE html>
<html>
<head>
    <title>Slip Gaji - {{ $employee->nip }}</title>
    <style>
        body { font-family: sans-serif; color: #333; }
        .container { width: 100%; padding: 20px; }
        .header { text-align: center; border-bottom: 2px solid #000; padding-bottom: 10px; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 24px; text-transform: uppercase; }
        .header p { margin: 5px 0; font-size: 12px; }

        .info-table { width: 100%; margin-bottom: 20px; }
        .info-table td { padding: 5px; }
        .label { font-weight: bold; width: 150px; }

        .salary-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .salary-table th, .salary-table td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        .salary-table th { background-color: #f4f4f4; }
        .total-row { background-color: #333; color: #fff; font-weight: bold; }

        .footer { margin-top: 50px; text-align: right; }
        .signature-box { display: inline-block; text-align: center; width: 200px; }
        .signature-line { border-bottom: 1px solid #000; margin-top: 60px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>PT. ARGO INDUSTRI</h1>
            <p>Jalan Teknologi No. 12, Jakarta Selatan, Indonesia</p>
            <p>Telp: (021) 555-7777 | Email: hr@argoindustri.com</p>
        </div>

        <h2 style="text-align: center; text-decoration: underline;">SLIP GAJI KARYAWAN</h2>

        <table class="info-table">
            <tr>
                <td class="label">NIP</td>
                <td>: {{ $employee->nip }}</td>
                <td class="label">Periode</td>
                <td>: {{ now()->format('F Y') }}</td>
            </tr>
            <tr>
                <td class="label">Nama</td>
                <td>: {{ $employee->name }}</td>
                <td class="label">Tanggal Cetak</td>
                <td>: {{ now()->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <td class="label">Jabatan</td>
                <td>: {{ strtoupper($employee->role) }}</td>
                <td class="label">Tgl Bergabung</td>
                <td>: {{ \Carbon\Carbon::parse($employee->join_date)->format('d-m-Y') }}</td>
            </tr>
        </table>

        <table class="salary-table">
            <thead>
                <tr>
                    <th>Keterangan</th>
                    <th style="text-align: right;">Jumlah (IDR)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Gaji Pokok</td>
                    <td style="text-align: right;">{{ number_format($employee->base_salary, 0, ',', '.') }}</td>
                </tr>

                @php
                    $inputVars = $slip->input_variables;
                    $bonusAmount = $slip->final_salary - $employee->base_salary;
                @endphp

                <tr>
                    <td>
                        Tunjangan / Bonus / Lembur
                        <br>
                        <small style="color: #666;">
                            @if($employee->role == 'satpam')
                                (Lembur: {{ $inputVars['overtime_hours'] ?? 0 }} Jam)
                            @elseif($employee->role == 'sales')
                                (Pelanggan: {{ $inputVars['total_customers'] ?? 0 }} Orang)
                            @elseif($employee->role == 'manager')
                                (Pertumbuhan: {{ $inputVars['sales_growth_percentage'] ?? 0 }}%)
                            @elseif($employee->role == 'admin')
                                (Masa Kerja: {{ now()->diffInYears($employee->join_date) }} Tahun)
                            @endif
                        </small>
                    </td>
                    <td style="text-align: right;">{{ number_format($bonusAmount, 0, ',', '.') }}</td>
                </tr>

                <tr class="total-row">
                    <td>TOTAL DITERIMA (TAKE HOME PAY)</td>
                    <td style="text-align: right;">Rp {{ number_format($slip->final_salary, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <div class="footer">
            <div class="signature-box">
                <p>Jakarta, {{ now()->format('d F Y') }}</p>
                <br>
                <p>Mengetahui, <br>HRD Manager</p>
                <div class="signature-line"></div>
                <p>( ................................. )</p>
            </div>
        </div>
    </div>
</body>
</html>
