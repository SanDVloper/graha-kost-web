<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'property_id', 'amount', 'status', 'due_date'];

    // Relasi balik ke User (Penghuni)
    public function user() {
        return $this->belongsTo(User::class);
    }

    // Relasi balik ke Kos (Property)
    public function property() {
        return $this->belongsTo(Property::class);
    }
}