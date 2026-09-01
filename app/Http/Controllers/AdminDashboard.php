<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class AdminDashboard extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('user')->latest()->get();
        return view('admin.dashboard', compact('transactions'));
    }

    public function approve(Transaction $transaction)
    {
        $transaction->update(['status' => 'lunas']);
        return back()->with('success', 'Transaksi berhasil dikonfirmasi / Lunas.');
    }
}
