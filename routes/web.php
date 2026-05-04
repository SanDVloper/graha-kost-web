<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController; 
use App\Http\Controllers\AuthController;

// --- RUTE AUTENTIKASI (Bebas diakses tanpa login) ---
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- RUTE TERLINDUNG (Wajib Login) ---
Route::middleware(['auth'])->group(function () {
    
    // Rute untuk halaman Dashboard Utama
    Route::get('/', [PropertyController::class, 'index']);
    // Rute untuk Pengaturan Akun Global
    Route::get('/settings', [App\Http\Controllers\AuthController::class, 'globalSettings'])->name('settings.global');
    Route::get('/property/{id}/manage', [PropertyController::class, 'manage'])->name('property.manage');
    // Rute untuk halaman Add Property (Step 1)
    Route::get('/add-property', [PropertyController::class, 'createStep1']);
    Route::post('/add-property', [PropertyController::class, 'storeStep1']);

    // Rute untuk halaman Step 2 (Tipe & Harga)
    Route::get('/property-cost/{id}', function ($id) {
        return view('property-cost', compact('id'));
    });
    Route::post('/property-cost/{id}', [PropertyController::class, 'storeStep2']);

    // Rute Step 3 (Pratinjau)
    Route::get('/property-publish/{id}', [PropertyController::class, 'publishStep3']);
    // Rute Manajemen Kamar & Fasilitas
    Route::get('/property/{id}/rooms', [PropertyController::class, 'roomList'])->name('property.rooms');
    // Rute Manajemen Penghuni
    Route::get('/property/{id}/occupants', [PropertyController::class, 'occupantList'])->name('property.occupants');
    // Rute Manajemen Tagihan & Sewa
    Route::get('/property/{id}/billing', [PropertyController::class, 'billingList'])->name('property.billing');
    // Rute Manajemen Keluhan
    Route::get('/property/{id}/complains', [PropertyController::class, 'complainList'])->name('property.complains');

    // Rute Pengaturan Properti
    Route::get('/property/{id}/settings', [PropertyController::class, 'settings'])->name('property.settings');
});