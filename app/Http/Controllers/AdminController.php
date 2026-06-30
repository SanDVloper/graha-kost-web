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
        $kosts = \App\Models\Property::with('user')->latest()->get();
        return view('admin.detail', compact('kosts'));
    }

    public function tagihan() {
        $tagihans = \App\Models\Billing::with(['user', 'property', 'room'])->latest()->get();
        return view('admin.tagihan', compact('tagihans'));
    }

    public function pembayaran() {
        $pembayarans = \App\Models\Billing::with(['user', 'property', 'room'])->where('status', 'paid')->latest()->get();
        return view('admin.pembayaran', compact('pembayarans'));
    }

    public function complaints()
    {
        $complaints = \App\Models\Complaint::with('user')->latest()->get();
        return view('admin.complaints.index', compact('complaints'));
    }

    public function updateStatus($id)
    {
        $complaint = \App\Models\Complaint::findOrFail($id);
        $complaint->update(['status' => request('status', 'selesai')]);
        return back()->with('success', 'Status komplain berhasil diupdate');
    }

    public function users()
    {
        $users = \App\Models\User::latest()->get();
        return view('admin.users', compact('users'));
    }

    public function storeAdmin(Request $request)
    {
        if (!auth()->user()->is_super_admin) {
            return abort(403, 'Hanya super admin yang dapat menambah admin baru.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $admin = \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'admin',
            'permissions' => $request->input('permissions', []),
        ]);

        return back()->with('success', 'Admin baru berhasil ditambahkan.');
    }

    public function updatePermissions(Request $request, $id)
    {
        if (!auth()->user()->is_super_admin) {
            return abort(403, 'Unauthorized action.');
        }

        $user = \App\Models\User::findOrFail($id);
        
        if ($user->role !== 'admin') {
            return back()->with('error', 'Hanya bisa mengatur hak akses untuk admin.');
        }

        $permissions = $request->input('permissions', []);
        $user->permissions = $permissions;
        $user->save();

        return back()->with('success', 'Hak akses berhasil diperbarui.');
    }

    public function laporan()
    {
        // 1. Finansial
        $gmv = \App\Models\Billing::where('status', 'paid')->sum('amount');
        $platformFee = $gmv * 0.05; // Asumsi 5% fee
        
        $totalBillings = \App\Models\Billing::count();
        $paidBillings = \App\Models\Billing::where('status', 'paid')->count();
        $waitingBillings = \App\Models\Billing::where('status', 'waiting_verification')->count();
        $pendingBillings = $totalBillings - $paidBillings - $waitingBillings;

        // 2. Pengguna
        $usersRole = \App\Models\User::select('role', DB::raw('count(*) as total'))
            ->groupBy('role')
            ->pluck('total', 'role')->toArray();

        // 3. Okupansi
        $totalRooms = \App\Models\Room::sum('quantity') ?: 1; // Cegah division by zero
        $occupiedRooms = \App\Models\User::where('role', 'penghuni')->count();
        $occupancyRate = min(100, round(($occupiedRooms / $totalRooms) * 100, 2));

        // 4. Komplain
        $complaints = \App\Models\Complaint::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')->toArray();
        
        // Rata-rata waktu penyelesaian (selisih hari updated_at - created_at untuk status selesai)
        $avgResolutionTime = \App\Models\Complaint::where('status', 'selesai')
            ->select(DB::raw('AVG(TIMESTAMPDIFF(HOUR, created_at, updated_at)) as avg_hours'))
            ->value('avg_hours') ?? 0;

        $stats = [
            'gmv' => $gmv,
            'platformFee' => $platformFee,
            'billings' => [
                'paid' => $paidBillings,
                'waiting' => $waitingBillings,
                'pending' => $pendingBillings,
                'total' => $totalBillings
            ],
            'users' => [
                'pencari' => $usersRole['pencari'] ?? 0,
                'penghuni' => $usersRole['penghuni'] ?? 0,
                'tuan_kos' => $usersRole['tuan_kos'] ?? 0,
            ],
            'occupancy' => [
                'total' => $totalRooms,
                'occupied' => $occupiedRooms,
                'rate' => $occupancyRate
            ],
            'complaints' => [
                'pending' => $complaints['pending'] ?? 0,
                'proses' => $complaints['proses'] ?? 0,
                'selesai' => $complaints['selesai'] ?? 0,
                'avg_resolution_hours' => round($avgResolutionTime, 1)
            ]
        ];

        return view('admin.laporan', compact('stats'));
    }

    public function exportCsv()
    {
        $billings = \App\Models\Billing::with(['user', 'property', 'room'])->latest()->get();

        $fileName = 'Laporan_Keuangan_GRAHA_' . date('Y-m-d') . '.csv';

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('ID Tagihan', 'Tanggal', 'Penyewa', 'Properti', 'Kamar', 'Status', 'Nominal');

        $callback = function() use($billings, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($billings as $b) {
                $row['ID Tagihan']  = 'INV-' . str_pad($b->id, 5, '0', STR_PAD_LEFT);
                $row['Tanggal']     = $b->created_at->format('Y-m-d');
                $row['Penyewa']     = $b->user->name ?? 'N/A';
                $row['Properti']    = $b->property->name ?? 'N/A';
                $row['Kamar']       = $b->room->name ?? 'N/A';
                $row['Status']      = $b->status;
                $row['Nominal']     = $b->amount;

                fputcsv($file, array($row['ID Tagihan'], $row['Tanggal'], $row['Penyewa'], $row['Properti'], $row['Kamar'], $row['Status'], $row['Nominal']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}