<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Package;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_orders'       => Order::count(),
            'total_packages'     => Package::count(),
            'total_users'        => User::where('role', 'member')->count(),
            'pending_payments'   => Payment::where('verification_status', 'Menunggu')->count(),
            'total_revenue'      => Order::where('order_status', 'Selesai')->sum('total_price'),
            'orders_today'       => Order::whereDate('created_at', today())->count(),
        ];

        $recentOrders = Order::with(['user', 'package'])->latest()->take(5)->get();

        $ordersByStatus = Order::select('order_status', DB::raw('count(*) as total'))
            ->groupBy('order_status')
            ->pluck('total', 'order_status');

        $popularPackages = Package::withCount('orders')
            ->orderByDesc('orders_count')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentOrders', 'ordersByStatus', 'popularPackages'));
    }

    public function reports()
    {
        $startDate = request('start_date', now()->startOfMonth()->toDateString());
        $endDate   = request('end_date', now()->toDateString());

        $orders = Order::with(['user', 'package'])
            ->whereBetween('order_date', [$startDate, $endDate])
            ->latest()
            ->get();

        $summary = [
            'total_orders'   => $orders->count(),
            'total_revenue'  => $orders->where('order_status', 'Selesai')->sum('total_price'),
            'total_pending'  => $orders->whereIn('order_status', ['Menunggu Pembayaran', 'Menunggu Verifikasi'])->count(),
            'total_cancelled'=> $orders->where('order_status', 'Dibatalkan')->count(),
        ];

        $packageSales = Order::with('package')
            ->whereBetween('order_date', [$startDate, $endDate])
            ->where('order_status', '!=', 'Dibatalkan')
            ->select('package_id', DB::raw('sum(quantity) as total_qty'), DB::raw('sum(total_price) as total_revenue'))
            ->groupBy('package_id')
            ->orderByDesc('total_revenue')
            ->get();

        return view('admin.reports', compact('orders', 'summary', 'packageSales', 'startDate', 'endDate'));
    }
}
