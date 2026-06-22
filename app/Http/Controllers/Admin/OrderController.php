<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'package', 'payment'])
            ->when(request('status'), fn($q) => $q->where('order_status', request('status')))
            ->when(request('search'), fn($q) => $q->whereHas('user', fn($u) => $u->where('name', 'like', '%' . request('search') . '%')))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $statuses = Order::STATUSES;

        return view('admin.orders.index', compact('orders', 'statuses'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'package.category', 'payment']);
        $statuses = Order::STATUSES;
        return view('admin.orders.show', compact('order', 'statuses'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'order_status' => 'required|in:' . implode(',', Order::STATUSES),
        ]);

        $order->update(['order_status' => $request->order_status]);

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }
}
