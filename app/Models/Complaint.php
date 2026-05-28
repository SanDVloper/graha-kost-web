<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    // Disamakan persis dengan isi tabel di migration kamu
    protected $fillable = [
        'user_id',
        'judul',
        'isi_komplain'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
