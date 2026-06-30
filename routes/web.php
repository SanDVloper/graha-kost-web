<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ComplaintController;

// ==========================================
// 1. RUTE AUTENTIKASI (Bebas diakses)
// ==========================================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==========================================
// 2. RUTE PUBLIK (Bebas diakses tanpa login - Landing Page / Katalog)
// ==========================================
Route::get('/', [CustomerController::class, 'index'])->name('welcome');
Route::get('/cari-kos', [CustomerController::class, 'index'])->name('customer.index');
Route::get('/detail-kos/{id}', [CustomerController::class, 'show'])->name('customer.show');

// ==========================================
// 3. RUTE PRIVATE (Harus Login Terlebih Dahulu)
// ==========================================
Route::middleware(['auth'])->group(function () {

    Route::get('/profile', [AuthController::class, 'profile'])->name('profile.show');
    Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('settings.profile');
    Route::get('/settings', [AuthController::class, 'globalSettings'])->name('settings.global');
    Route::post('/settings/password', [AuthController::class, 'updatePassword'])->name('settings.password');

    // ==========================================
    // RUTE KHUSUS LENGKAPI PROFIL LANDLORD
    // ==========================================
    Route::post('/landlord/complete-profile', [AuthController::class, 'completeProfileStore'])->name('landlord.profile.store');

    Route::get('/dashboard-landlord', [PropertyController::class, 'index'])->name('landlord.dashboard');

    // ==========================================
    // RUTE LANDLORD DENGAN MIDDLEWARE PROFIL
    // ==========================================
    Route::middleware(['landlord.profile'])->group(function () {
        
    Route::get('/add-property', [PropertyController::class, 'createStep1']);
    Route::post('/add-property', [PropertyController::class, 'storeStep1']);

    Route::get('/property-cost', function () {
        if (!session()->has('property_step1')) {
            return redirect('/add-property');
        }
        return view('landlord.property-cost');
    });
    Route::post('/property-cost', [PropertyController::class, 'storeStep2']);
    Route::get('/property-publish/{id}', [PropertyController::class, 'publishStep3']);

    Route::get('/property/{id}/manage', [PropertyController::class, 'manage'])->name('property.manage');
    Route::get('/property/{id}/rooms', [PropertyController::class, 'roomList'])->name('property.rooms');
    Route::post('/property/{id}/rooms', [PropertyController::class, 'storeRoom'])->name('property.rooms.store');
    Route::put('/property/{id}/rooms/{room_id}', [PropertyController::class, 'updateRoom'])->name('property.rooms.update');
    Route::delete('/property/{id}/rooms/{room_id}', [PropertyController::class, 'deleteRoom'])->name('property.rooms.destroy');
    Route::get('/property/{id}/occupants', [PropertyController::class, 'occupantList'])->name('property.occupants');
    Route::post('/property/{id}/occupants/{billing_id}/evict', [PropertyController::class, 'evictOccupant'])->name('property.occupants.evict');
    Route::post('/property/{id}/occupants/{billing_id}/move', [PropertyController::class, 'moveOccupant'])->name('property.occupants.move');
    Route::get('/property/{id}/billing', [PropertyController::class, 'billingList'])->name('property.billing');
    Route::post('/property/{id}/billing/{billing_id}/verify', [PropertyController::class, 'verifyPayment'])->name('property.billing.verify');
    Route::get('/property/{id}/complains', [PropertyController::class, 'complainList'])->name('property.complains');
    Route::post('/property/{id}/complains/broadcast', [PropertyController::class, 'broadcastComplain'])->name('property.complains.broadcast');
    Route::get('/property/{id}/applications', [PropertyController::class, 'applications'])->name('property.applications');
    Route::post('/property/{id}/applications/{billing_id}/accept', [PropertyController::class, 'acceptApplication'])->name('property.applications.accept');
    Route::post('/property/{id}/applications/{billing_id}/reject', [PropertyController::class, 'rejectApplication'])->name('property.applications.reject');
    Route::get('/property/{id}/settings', [PropertyController::class, 'settings'])->name('property.settings');
    Route::post('/property/{id}/settings', [PropertyController::class, 'updateSettings'])->name('property.settings.update');
    Route::post('/property/{id}/deactivate', [PropertyController::class, 'deactivate'])->name('property.deactivate');
    Route::delete('/property/{id}', [PropertyController::class, 'destroy'])->name('property.destroy');
    });

    Route::post('/enroll-kos', [CustomerController::class, 'enroll'])->name('customer.enroll');

    Route::get('/tagihan-saya', [CustomerController::class, 'billing'])->name('customer.billing');
    Route::post('/bayar-tagihan/{id}', [CustomerController::class, 'pay'])->name('customer.pay');
    Route::post('/bayar-qris/{id}', [CustomerController::class, 'payQris'])->name('customer.payQris');

    Route::get('/kuitansi-saya/{id}', [CustomerController::class, 'invoice'])->name('customer.invoice');

    Route::get('/komplain-saya', function() {
        return view('customer.complain');
    })->name('customer.complain.view');

    Route::post('/kirim-komplain', [CustomerController::class, 'complain'])->name('customer.complain');

    // 🟢 PERBAIKAN: Mengarahkan rute kos-saya ke method myKos di CustomerController
    Route::get('/kos-saya', [CustomerController::class, 'myKos'])->name('customer.myKos');

    Route::get('/beri-ulasan/{id}', function($id) {
        $property = \App\Models\Property::findOrFail($id);
        return view('customer.ulasan', compact('property'));
    })->name('customer.ulasan');
    Route::post('/beri-rating', [CustomerController::class, 'rate'])->name('customer.rate');

});

// ==========================================
// 4. RUTE MIDDLEWARE ADMIN
// ==========================================
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard')->middleware('admin.permission:dashboard');
    Route::get('/kost/detail', [AdminController::class, 'kostDetail'])->name('detail')->middleware('admin.permission:detail');
    Route::get('/tagihan', [AdminController::class, 'tagihan'])->name('tagihan')->middleware('admin.permission:tagihan');
    Route::get('/pembayaran', [AdminController::class, 'pembayaran'])->name('pembayaran')->middleware('admin.permission:tagihan');
    Route::get('/complaints', [AdminController::class, 'complaints'])->name('complaints.index')->middleware('admin.permission:complaints');
    Route::put('/complaints/{id}', [AdminController::class, 'updateStatus'])->name('complaints.updateStatus')->middleware('admin.permission:complaints');
    // Route::get('/kost/{id}', [KostController::class, 'show'])->name('kost.show'); // Telah dialihkan ke customer.show
    Route::get('/users', [AdminController::class, 'users'])->name('users')->middleware('admin.permission:users');
    Route::post('/users/admin', [AdminController::class, 'storeAdmin'])->name('users.admin.store')->middleware('admin.permission:users');
    Route::put('/users/{id}/permissions', [AdminController::class, 'updatePermissions'])->name('users.permissions')->middleware('admin.permission:users');
    Route::get('/laporan', [AdminController::class, 'laporan'])->name('laporan')->middleware('admin.permission:laporan');
    Route::get('/laporan/export', [AdminController::class, 'exportCsv'])->name('laporan.export')->middleware('admin.permission:laporan');
});
