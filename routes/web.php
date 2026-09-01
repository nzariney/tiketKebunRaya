<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AdminDashboard;
use Illuminate\Support\Facades\Route;
use App\Models\Ticket;

// Public Home (Ticket Booking)
Route::get('/', function () {
    $tickets = Ticket::all();
    return view('welcome', compact('tickets'));
})->name('home');

Route::middleware('auth')->group(function () {
    // User routes
    Route::post('/checkout', [TransactionController::class, 'checkout'])->name('checkout');
    Route::get('/dashboard', [TransactionController::class, 'index'])->name('dashboard');
    Route::get('/transaction/{transaction}', [TransactionController::class, 'show'])->name('transaction.show');
    Route::post('/transaction/{transaction}/proof', [TransactionController::class, 'uploadProof'])->name('transaction.proof');
    Route::get('/transaction/{transaction}/ticket', [TransactionController::class, 'downloadTicket'])->name('transaction.ticket');

    // Profile routes (Breeze default)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Admin routes
    Route::middleware('can:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
        Route::post('/transaction/{transaction}/approve', [AdminDashboard::class, 'approve'])->name('transaction.approve');
    });
});

require __DIR__.'/auth.php';
