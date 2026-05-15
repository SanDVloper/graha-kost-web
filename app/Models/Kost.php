<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kost extends Model
{
    use HasFactory;

    protected $table = 'kosts'; // sesuaikan nama tabel kamu

    protected $fillable = [
        'nama_kost',
        'alamat',
        'owner_id',
        'jumlah_kamar',
        'denah'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}