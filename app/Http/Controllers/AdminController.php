<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;

class AdminController extends Controller
{
    public function dashboard() {
        return view('admin.dashboard'); // Mengarah ke file dashboard.blade.php
    }

    public function kostDetail() {
        return view('admin.detail');
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

      public function complaints() {

        $complaints = Complaint::latest()->get();

        return view('admin.complaints.index', compact('complaints'));
    }
     
}