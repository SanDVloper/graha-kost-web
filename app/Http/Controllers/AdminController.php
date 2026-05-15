<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use App\Models\Kost;
use Illuminate\Support\Facades\DB;
class AdminController extends Controller
{
    public function dashboard() {
        return view('admin.dashboard'); // Mengarah ke file dashboard.blade.php
    }
  public function kostDetail(Request $request)
{
    $kosts = DB::table('kosts')->get();

     
    return view('admin.detail', compact('kosts'));
}

    public function enrollment() {
        return view('admin.enrollment');
    }

    public function tagihan() {
        return view('admin.tagihan');
    }

    public function pembayaran() {
        return view('admin.pembayaran');
    }

     public function complaints()
{
    $complaints = collect([
        (object)[
            'id' => 1,
            'user' => (object)[
                'name' => 'Budi Santoso',
                'email' => 'budi@mail.com'
            ],
            'judul' => 'Cara bayar kost gimana?',
            'status' => 'pending',
            'priority' => 'high'
        ],
        (object)[
            'id' => 2,
            'user' => (object)[
                'name' => 'Siti Aminah',
                'email' => 'siti@mail.com'
            ],
            'judul' => 'Webnya error',
            'status' => 'proses',
            'priority' => 'medium'
        ],
        (object)[
            'id' => 3,
            'user' => (object)[
                'name' => 'Andi',
                'email' => 'andi@mail.com'
            ],
            'judul' => 'Tidak bisa chat tuan kost',
            'status' => 'selesai',
            'priority' => 'low'
        ],
    ]);

    return view('admin.complaints.index', compact('complaints'));
}

public function updateStatus($id)
{
    // karena dummy, kita cuma return balik
    return back()->with('success', 'Status berhasil diupdate (dummy mode)');
}

public function users()
{
    $users = collect([

        (object)[
            'name' => 'Guntur Putra',
            'email' => 'guntur@mail.com',
            'role' => 'owner',
            'status' => 'aktif',
        ],

        (object)[
            'name' => 'Siti Aminah',
            'email' => 'siti@mail.com',
            'role' => 'penghuni',
            'status' => 'aktif',
        ],

        (object)[
            'name' => 'Budi Santoso',
            'email' => 'budi@mail.com',
            'role' => 'user',
            'status' => 'pending',
        ],

    ]);

    return view('admin.users', compact('users'));
}
     
}