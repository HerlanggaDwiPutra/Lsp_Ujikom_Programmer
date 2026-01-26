<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    protected $fillable = ['electricity_tariff_id', 'nomor_kwh', 'nama_pelanggan', 'alamat'];

    public function tariff(): BelongsTo
    {
        return $this->belongsTo(ElectricityTariff::class, 'electricity_tariff_id');
    }

    public function bills(): HasMany
    {
        return $this->hasMany(Bill::class);
    }
}
