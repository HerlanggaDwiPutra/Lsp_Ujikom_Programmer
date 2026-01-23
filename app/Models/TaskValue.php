<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TaskValue
 * Model ini merepresentasikan tabel 'task_values' di database.
 * * @package App\Models
 */
class TaskValue extends Model
{
    /**
     * Daftar kolom yang boleh diisi secara massal (Mass Assignment).
     * @var array
     */
    protected $fillable = [
        'session_name',
        'input_numbers',
        'sorted_numbers',
        'file_path'
    ];

    /**
     * Mengubah format data secara otomatis saat diakses.
     * Array PHP akan otomatis diubah jadi JSON saat simpan, dan sebaliknya.
     * * @var array
     */
    protected $casts = [
        'input_numbers' => 'array',
        'sorted_numbers' => 'array',
    ];
}
