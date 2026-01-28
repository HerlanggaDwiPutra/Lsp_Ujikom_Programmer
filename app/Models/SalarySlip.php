<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalarySlip extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'base_salary',      // Baru
        'years_of_service', // Baru
        'details',          // Ganti input_variables
        'final_salary',
        'generated_at',
    ];

    protected $casts = [
        'details' => 'array', // Auto-convert JSON ke Array
        'generated_at' => 'datetime',
        'base_salary' => 'decimal:2',
        'final_salary' => 'decimal:2',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
