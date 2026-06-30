<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'property_id', 'room_id', 'amount', 'status',
        'due_date', 'duration', 'bukti_transfer', 'assigned_room_number',
    ];

    // Relasi balik ke User (Penghuni)
    public function user() {
        return $this->belongsTo(User::class);
    }

    // Relasi balik ke Kos (Property)
    public function property() {
        return $this->belongsTo(Property::class);
    }

    // Relasi balik ke Kamar (Room)
    public function room() {
        return $this->belongsTo(Room::class);
    }
}