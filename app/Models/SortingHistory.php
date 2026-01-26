<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SortingHistory extends Model
{
    // Izinkan semua kolom diisi
    protected $guarded = [];

    // Casting agar otomatis jadi JSON saat simpan/baca
    protected $casts = [
        'input_numbers' => 'array',
        'sorted_numbers' => 'array',
    ];
}
