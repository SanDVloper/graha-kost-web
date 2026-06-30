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

    public function billings()
    {
        return $this->hasMany(Billing::class);
    }

    public function complains()
    {
        return $this->hasMany(Complain::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}