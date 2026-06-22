<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with(['order.user', 'order.package'])
            ->when(request('status'), fn($q) => $q->where('verification_status', request('status')))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.payments.index', compact('payments'));
    }

    public function show(Payment $payment)
    {
        $payment->load(['order.user', 'order.package']);
        return view('admin.payments.show', compact('payment'));
    }

    public function verify(Request $request, Payment $payment)
    {
        $request->validate([
            'verification_status' => 'required|in:Disetujui,Ditolak',
            'notes'               => 'nullable|string|max:500',
        ]);

        $payment->update([
            'verification_status' => $request->verification_status,
            'notes'               => $request->notes,
        ]);

        // Update order status
        if ($request->verification_status === 'Disetujui') {
            $payment->order->update(['order_status' => 'Diproses']);
        } elseif ($request->verification_status === 'Ditolak') {
            $payment->order->update(['order_status' => 'Menunggu Pembayaran']);
        }

        return back()->with('success', 'Pembayaran berhasil diverifikasi.');
    }
}
