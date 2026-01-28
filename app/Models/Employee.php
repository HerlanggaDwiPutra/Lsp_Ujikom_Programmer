<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'nip',
        'name',
        'join_year',
        'base_salary',
        'role'
    ];

    // Relasi ke Slip Gaji
    public function salarySlips()
    {
        return $this->hasMany(SalarySlip::class);
    }
}
