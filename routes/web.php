<?php

use App\Http\Controllers\BillingController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicProfileController;
use Illuminate\Support\Facades\Route;

// =========================================================
// PUBLIC ROUTES
// =========================================================

Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/links/{link}/go', [PublicProfileController::class, 'redirect'])->name('links.go');

// =========================================================
// AUTHENTICATED ROUTES
// =========================================================

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Links CRUD (tanpa show)
    Route::resource('/links', LinkController::class)->except(['show']);
    Route::patch('/links/{link}/toggle', [LinkController::class, 'toggle'])->name('links.toggle');
    Route::post('/links/reorder', [LinkController::class, 'reorder'])->name('links.reorder');

    // Billing
    Route::get('/billing', [BillingController::class, 'index'])->name('billing.index');

    // Checkout (Midtrans & Simulation)
    Route::post('/checkout/{plan}', [CheckoutController::class, 'create'])->name('checkout.create');
    Route::get('/checkout/payment-simulation', [CheckoutController::class, 'simulation'])->name('checkout.simulation');
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/checkout/pending', [CheckoutController::class, 'pending'])->name('checkout.pending');
    Route::get('/checkout/error', [CheckoutController::class, 'error'])->name('checkout.error');
    Route::post('/checkout/callback', [CheckoutController::class, 'callback'])->name('checkout.callback');
    
    
    // =========================================================
    // PROFILE ROUTES (Breeze default)
    // =========================================================
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/theme', [ProfileController::class, 'updateTheme'])->name('profile.theme.update');
    Route::delete('/profile/avatar', [ProfileController::class, 'destroyAvatar'])->name('profile.avatar.destroy');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// =========================================================
// AUTH ROUTES (Breeze)
// =========================================================

require __DIR__ . '/auth.php';

// =========================================================
// PUBLIC PROFILE — MUST BE LAST (catch-all slug)
// =========================================================

Route::get('/{username}', [PublicProfileController::class, 'show'])->name('profile.show');
