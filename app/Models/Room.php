<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'name',
        'size',
        'quantity',
        'facilities',
        'price_monthly',
        'price_daily',
        'price_yearly'
    ];

    protected $casts = [
        'facilities' => 'array',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}