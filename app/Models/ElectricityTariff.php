<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ElectricityTariff extends Model
{
    protected $table = 'electricity_tariffs';
    protected $fillable = ['user_id', 'kd_tarif', 'beban', 'tarif_per_kwh'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class);
    }
}
