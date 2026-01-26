<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Employee
 * Merepresentasikan data pegawai tetap di perusahaan.
 */
class Employee extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'nip',
        'name',
        'role',
        'join_date',
        'base_salary',
    ];

    /**
     * Casting tipe data otomatis.
     * - join_date diubah jadi objek Carbon (Date)
     * - base_salary dipastikan jadi float/integer
     */
    protected $casts = [
        'join_date' => 'date',
        'base_salary' => 'decimal:2',
    ];

    /**
     * Relasi One-to-Many: Satu pegawai memiliki banyak slip gaji.
     */
    public function salarySlips(): HasMany
    {
        return $this->hasMany(SalarySlip::class);
    }
}
