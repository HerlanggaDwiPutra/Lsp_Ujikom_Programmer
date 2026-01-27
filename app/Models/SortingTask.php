<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SortingTask extends Model
{
    protected $guarded = [];

    // Casting otomatis JSON ke Array (Best Practice)
    protected $casts = [
        'input_numbers' => 'array',
        'sorted_numbers' => 'array',
    ];
}
