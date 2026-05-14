<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $guarded = [];

    // INI BAGIAN PALING PENTINGNYA, TUANKU:
    protected $casts = [
        'facilities' => 'array',
        'photos' => 'array',
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}