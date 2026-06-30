<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'property_id',
        'room_id',
        'duration',
        'start_date',
        'note',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
    ];

    // Relasi ke User (Pelamar)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Property (Kos yang dilamar)
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    // Relasi ke Room (Tipe kamar yang diinginkan)
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
