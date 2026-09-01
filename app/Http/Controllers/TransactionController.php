<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Ticket;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        // Admin redirect
        if ($request->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        $transactions = $request->user()->transactions()->latest()->get();
        return view('dashboard', compact('transactions'));
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'visit_date' => 'required|date|after_or_equal:today',
            'adult_quantity' => 'required|integer|min:0',
            'child_quantity' => 'required|integer|min:0',
        ]);

        if ($request->adult_quantity == 0 && $request->child_quantity == 0) {
            return back()->withErrors(['message' => 'Silahkan pilih minimal 1 tiket.']);
        }

        $adultTicket = Ticket::where('category', 'Dewasa')->first();
        $childTicket = Ticket::where('category', 'Anak')->first();

        $adultPrice = $adultTicket ? $adultTicket->price : 25000;
        $childPrice = $childTicket ? $childTicket->price : 15000;

        $totalPrice = ($adultPrice * $request->adult_quantity) + ($childPrice * $request->child_quantity);

        $transaction = $request->user()->transactions()->create([
            'invoice_code' => 'INV-' . strtoupper(Str::random(10)),
            'visit_date' => $request->visit_date,
            'adult_quantity' => $request->adult_quantity,
            'child_quantity' => $request->child_quantity,
            'adult_price' => $adultPrice,
            'child_price' => $childPrice,
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        return redirect()->route('transaction.show', $transaction);
    }

    public function show(Transaction $transaction)
    {
        if ($transaction->user_id !== auth()->id()) {
            abort(403);
        }

        return view('transaction.show', compact('transaction'));
    }

    public function uploadProof(Request $request, Transaction $transaction)
    {
        if ($transaction->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = $request->file('payment_proof')->store('payment_proofs', 'public');
        
        $transaction->update([
            'payment_proof' => $path,
            'status' => 'pending'
        ]);

        return redirect()->route('dashboard')->with('success', 'Bukti pembayaran berhasil diunggah. Menunggu konfirmasi admin.');
    }

    public function downloadTicket(Transaction $transaction)
    {
        if ($transaction->user_id !== auth()->id()) {
            abort(403);
        }

        if ($transaction->status !== 'lunas') {
            abort(403, 'Tiket belum bisa diunduh. Menunggu konfirmasi.');
        }

        $qrcode = base64_encode(QrCode::format('svg')->size(150)->generate($transaction->invoice_code));

        $pdf = Pdf::loadView('ticket.pdf', compact('transaction', 'qrcode'));
        return $pdf->download('E-Ticket-' . $transaction->invoice_code . '.pdf');
    }
}
