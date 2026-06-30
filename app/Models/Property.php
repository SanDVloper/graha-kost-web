<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'facilities' => 'array',
        'photos' => 'array',
        'rules' => 'array',
        'garbage_management' => 'array',
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
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