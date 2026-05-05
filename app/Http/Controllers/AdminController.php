<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}