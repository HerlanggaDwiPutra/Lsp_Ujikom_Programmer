<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class SalarySlip
 * Menyimpan riwayat perhitungan gaji yang sudah difinalisasi.
 */
class SalarySlip extends Model
{
    protected $fillable = [
        'employee_id',
        'input_variables',
        'final_salary',
        'generated_at',
    ];

    /**
     * Casting tipe data.
     * Penting: 'input_variables' di-cast ke 'array' agar JSON di database
     * otomatis berubah jadi Array PHP saat diambil.
     */
    protected $casts = [
        'input_variables' => 'array', // JSON to Array
        'final_salary' => 'decimal:2',
        'generated_at' => 'datetime',
    ];

    /**
     * Relasi Inverse: Slip gaji milik satu pegawai.
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
