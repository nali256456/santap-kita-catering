<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Package;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['package', 'payment'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('member.orders.index', compact('orders'));
    }

    public function create(Package $package)
    {
        return view('member.orders.create', compact('package'));
    }

    public function store(Request $request, Package $package)
    {
        $validated = $request->validate([
            'quantity'         => 'required|integer|min:1|max:1000',
            'delivery_date'    => 'required|date|after:today',
            'delivery_address' => 'required|string|max:500',
            'payment_method'   => 'required|in:transfer',
            'notes'            => 'nullable|string|max:500',
        ], [
            'quantity.required'         => 'Jumlah porsi wajib diisi.',
            'quantity.min'              => 'Minimal 1 porsi.',
            'delivery_date.required'    => 'Tanggal pengiriman wajib diisi.',
            'delivery_date.after'       => 'Tanggal pengiriman harus setelah hari ini.',
            'delivery_address.required' => 'Alamat pengiriman wajib diisi.',
            'payment_method.required'   => 'Metode pembayaran wajib dipilih.',
        ]);

        $totalPrice = $package->price * $validated['quantity'];

        $order = Order::create([
            'user_id'          => Auth::id(),
            'package_id'       => $package->id,
            'quantity'         => $validated['quantity'],
            'order_date'       => now()->toDateString(),
            'delivery_date'    => $validated['delivery_date'],
            'delivery_address' => $validated['delivery_address'],
            'total_price'      => $totalPrice,
            'payment_method'   => $validated['payment_method'],
            'order_status'     => 'Menunggu Pembayaran',
            'notes'            => $validated['notes'] ?? null,
        ]);

        return redirect()->route('member.orders.show', $order)
            ->with('success', 'Pesanan berhasil dibuat! Silakan lakukan pembayaran.');
    }

    public function show(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }
        $order->load(['package.category', 'payment']);
        return view('member.orders.show', compact('order'));
    }

    public function uploadPayment(Request $request, Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        if ($order->order_status !== 'Menunggu Pembayaran') {
            return back()->with('error', 'Status pesanan tidak memungkinkan upload bukti pembayaran.');
        }

        $request->validate([
            'proof_payment' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'proof_payment.required' => 'Bukti pembayaran wajib diunggah.',
            'proof_payment.image'    => 'File harus berupa gambar.',
            'proof_payment.mimes'    => 'Format file harus JPG atau PNG.',
            'proof_payment.max'      => 'Ukuran file maksimal 2MB.',
        ]);

        $file     = $request->file('proof_payment');
        $filename = 'payment_' . $order->id . '_' . time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/payments', $filename);

        Payment::updateOrCreate(
            ['order_id' => $order->id],
            [
                'payment_date'        => now()->toDateString(),
                'proof_payment'       => $filename,
                'verification_status' => 'Menunggu',
            ]
        );

        $order->update(['order_status' => 'Menunggu Verifikasi']);

        return back()->with('success', 'Bukti pembayaran berhasil diunggah. Menunggu verifikasi admin.');
    }

    public function cancel(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        if (!$order->canBeCancelled()) {
            return back()->with('error', 'Pesanan tidak dapat dibatalkan pada status ini.');
        }

        $order->update(['order_status' => 'Dibatalkan']);

        return back()->with('success', 'Pesanan berhasil dibatalkan.');
    }

    public function profile()
    {
        return view('member.profile', ['user' => Auth::user()]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        $user->update($request->only(['name', 'phone', 'address']));

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password'      => 'required|current_password',
            'password'              => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
        ], [
            'current_password.current_password' => 'Password saat ini tidak sesuai.',
            'password.min'                      => 'Password baru minimal 8 karakter.',
            'password.confirmed'                => 'Konfirmasi password tidak cocok.',
        ]);

        Auth::user()->update(['password' => bcrypt($request->password)]);

        return back()->with('success', 'Password berhasil diperbarui.');
    }
}
