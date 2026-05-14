<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
<<<<<<< HEAD
use App\Models\Complaint;
=======
>>>>>>> 49c3cf517adcd415cecc4e0f02dd1bb68627fd28

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
<<<<<<< HEAD

      public function complaints() {

        $complaints = Complaint::latest()->get();

        return view('admin.complaints.index', compact('complaints'));
    }
     
=======
>>>>>>> 49c3cf517adcd415cecc4e0f02dd1bb68627fd28
}