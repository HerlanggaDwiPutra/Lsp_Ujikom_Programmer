<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bill extends Model
{
    protected $fillable = ['customer_id', 'tahun_tagihan', 'bulan_tagihan', 'pemakaian'];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
