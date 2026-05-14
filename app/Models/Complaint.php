<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
<<<<<<< HEAD
    protected $fillable = [
        'user_id',
        'judul',
        'isi_komplain',
        'status'
    ];

    public function user()
    {
=======
    use HasFactory;

    protected $fillable = ['user_id', 'pesan', 'status'];

    // Relasi balik ke User (Penghuni)
    public function user() {
>>>>>>> 49c3cf517adcd415cecc4e0f02dd1bb68627fd28
        return $this->belongsTo(User::class);
    }
}