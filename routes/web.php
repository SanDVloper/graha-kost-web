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
// 2. RUTE PUBLIK (Bebas diakses tanpa login)
// ==========================================
Route::get('/cari-kos', [CustomerController::class, 'index'])->name('customer.index');
Route::get('/detail-kos/{id}', [CustomerController::class, 'show'])->name('customer.show');

Route::middleware(['auth'])->group(function () {
    
    Route::get('/settings', [AuthController::class, 'globalSettings'])->name('settings.global');

    Route::get('/', [PropertyController::class, 'index']);
    
    Route::get('/add-property', [PropertyController::class, 'createStep1']);
    Route::post('/add-property', [PropertyController::class, 'storeStep1']);

    Route::get('/property-cost/{id}', function ($id) {
        return view('landlord.property-cost', compact('id'));
    });
    Route::post('/property-cost/{id}', [PropertyController::class, 'storeStep2']);
    Route::get('/property-publish/{id}', [PropertyController::class, 'publishStep3']);

    Route::get('/property/{id}/manage', [PropertyController::class, 'manage'])->name('property.manage');
    Route::get('/property/{id}/rooms', [PropertyController::class, 'roomList'])->name('property.rooms');
    Route::get('/property/{id}/occupants', [PropertyController::class, 'occupantList'])->name('property.occupants');
    Route::get('/property/{id}/billing', [PropertyController::class, 'billingList'])->name('property.billing');
    Route::get('/property/{id}/complains', [PropertyController::class, 'complainList'])->name('property.complains');
    Route::get('/property/{id}/settings', [PropertyController::class, 'settings'])->name('property.settings');

    Route::post('/enroll-kos', [CustomerController::class, 'enroll'])->name('customer.enroll');
    
    Route::get('/tagihan-saya', [CustomerController::class, 'billing'])->name('customer.billing');
    Route::post('/bayar-tagihan/{id}', [CustomerController::class, 'pay'])->name('customer.pay');
    Route::post('/kirim-komplain', [CustomerController::class, 'complain'])->name('customer.complain');
    
    Route::get('/beri-ulasan/{id}', function($id) {
        $property = \App\Models\Property::findOrFail($id);
        return view('customer.ulasan', compact('property'));
    })->name('customer.ulasan');
    Route::post('/beri-rating', [CustomerController::class, 'rate'])->name('customer.rate');

});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
 
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/kost/detail', [AdminController::class, 'kostDetail'])->name('kost.detail');
    Route::get('/enrollment', [AdminController::class, 'enrollment'])->name('enrollment');
    Route::get('/tagihan', [AdminController::class, 'tagihan'])->name('tagihan');
    Route::get('/pembayaran', [AdminController::class, 'pembayaran'])->name('pembayaran');
   Route::get('/complaints', [AdminController::class, 'complaints'])
    ->name('complaints.index');
});

