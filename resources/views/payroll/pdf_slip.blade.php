<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Slip Gaji - {{ $employee->nip }}</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
            color: #333;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            text-transform: uppercase;
            font-size: 24px;
        }
        .header p {
            margin: 5px 0 0;
            font-size: 12px;
        }
        .info-table {
            width: 100%;
            margin-bottom: 20px;
        }
        .info-table td {
            padding: 5px;
        }
        .salary-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .salary-table th, .salary-table td {
            border: 1px solid #ddd;
            padding: 10px;
        }
        .salary-table th {
            background-color: #f4f4f4;
            text-align: left;
        }
        .text-right {
            text-align: right;
        }
        .text-bold {
            font-weight: bold;
        }
        .footer {
            margin-top: 50px;
            text-align: right;
            font-size: 12px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>PT. ARGO INDUSTRI</h1>
        <p>Jalan Raya Industri No. 123, Bogor - Indonesia</p>
        <p>Telp: (021) 12345678 | Email: hrd@argoindustri.com</p>
    </div>

    <h2 style="text-align: center; margin-bottom: 30px;">SLIP GAJI PEGAWAI</h2>

    <table class="info-table">
        <tr>
            <td width="20%"><strong>NIP</strong></td>
            <td width="30%">: {{ $employee->nip }}</td>
            <td width="20%"><strong>Jabatan</strong></td>
            <td width="30%">: {{ ucfirst($employee->role) }}</td>
        </tr>
        <tr>
            <td><strong>Nama</strong></td>
            <td>: {{ $employee->name }}</td>
            <td><strong>Tahun Masuk</strong></td>
            <td>: {{ $employee->join_year }}</td>
        </tr>
        <tr>
            <td><strong>Periode</strong></td>
            <td>: {{ $slip->generated_at->format('F Y') }}</td>
            <td><strong>Lama Kerja</strong></td>
            <td>: {{ $slip->years_of_service }} Tahun</td>
        </tr>
    </table>

    <table class="salary-table">
        <thead>
            <tr>
                <th>Keterangan</th>
                <th class="text-right">Nominal (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Gaji Pokok</td>
                <td class="text-right">{{ number_format($slip->base_salary, 0, ',', '.') }}</td>
            </tr>

            @php
                // Ambil detail input dari kolom 'details' (dulu input_variables)
                $details = $slip->details ?? [];
                $role = $employee->role;
            @endphp

            @if($role === 'satpam' && isset($details['overtime_hours']))
                <tr>
                    <td>
                        Honor Lembur <br>
                        <small>({{ $details['overtime_hours'] }} jam x Rp 20.000)</small>
                    </td>
                    <td class="text-right">
                        {{ number_format($details['overtime_hours'] * 20000, 0, ',', '.') }}
                    </td>
                </tr>
            @elseif($role === 'sales' && isset($details['total_customers']))
                <tr>
                    <td>
                        Komisi Penjualan <br>
                        <small>({{ $details['total_customers'] }} pelanggan x Rp 50.000)</small>
                    </td>
                    <td class="text-right">
                        {{ number_format($details['total_customers'] * 50000, 0, ',', '.') }}
                    </td>
                </tr>
            @elseif($role === 'manager' && isset($details['sales_growth_percentage']))
                <tr>
                    <td>
                        Bonus Kinerja <br>
                        <small>(Peningkatan Penjualan: {{ $details['sales_growth_percentage'] }}%)</small>
                    </td>
                    <td class="text-right">
                        {{ number_format($slip->final_salary - $slip->base_salary, 0, ',', '.') }}
                    </td>
                </tr>
            @elseif($role === 'admin')
                <tr>
                    <td>
                        Tunjangan Masa Kerja <br>
                        <small>({{ $slip->years_of_service }} Tahun)</small>
                    </td>
                    <td class="text-right">
                        {{ number_format($slip->final_salary - $slip->base_salary, 0, ',', '.') }}
                    </td>
                </tr>
            @endif

            <tr style="background-color: #f9f9f9;">
                <td class="text-bold">TOTAL GAJI DITERIMA</td>
                <td class="text-right text-bold" style="font-size: 16px;">
                    Rp {{ number_format($slip->final_salary, 0, ',', '.') }}
                </td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ now()->format('d F Y H:i') }}</p>
        <br><br><br>
        <p>( Bagian Keuangan )</p>
    </div>

</body>
</html>
