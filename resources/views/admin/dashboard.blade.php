@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')

@section('content')
<div class="stat-grid">
    <div class="stat-card">
        <div class="stat-icon">📋</div>
        <div class="stat-val">{{ $stats['total_orders'] }}</div>
        <div class="stat-label">Total Pesanan</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon">🍱</div>
        <div class="stat-val">{{ $stats['total_packages'] }}</div>
        <div class="stat-label">Total Paket</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon">👥</div>
        <div class="stat-val">{{ $stats['total_users'] }}</div>
        <div class="stat-label">Total Pelanggan</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon">💳</div>
        <div class="stat-val">{{ $stats['pending_payments'] }}</div>
        <div class="stat-label">Menunggu Verifikasi</div>
    </div>
</div>

<div class="stat-grid" style="grid-template-columns: 1fr 1fr;">
    <div class="stat-card">
        <div class="stat-icon">💰</div>
        <div class="stat-val">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</div>
        <div class="stat-label">Total Pendapatan (Pesanan Selesai)</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon">📅</div>
        <div class="stat-val">{{ $stats['orders_today'] }}</div>
        <div class="stat-label">Pesanan Hari Ini</div>
    </div>
</div>

<div class="detail-grid" style="align-items:start; grid-template-columns: 1.6fr 1fr;">
    <div class="panel">
        <div class="panel-head">
            <h3>Pesanan Terbaru</h3>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-outline btn-sm">Lihat Semua</a>
        </div>
        @if($recentOrders->count() > 0)
            <div class="table-wrap">
                <table class="data-table">
                    <thead>
                        <tr><th>Pelanggan</th><th>Paket</th><th>Total</th><th>Status</th><th></th></tr>
                    </thead>
                    <tbody>
                        @foreach($recentOrders as $order)
                            <tr>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ $order->package->package_name }}</td>
                                <td>{{ $order->formatted_total_price }}</td>
                                <td><span class="badge badge-{{ $order->status_badge }}">{{ $order->order_status }}</span></td>
                                <td><a href="{{ route('admin.orders.show', $order) }}" class="btn btn-outline btn-sm">Detail</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-state"><div class="emoji">📭</div><p>Belum ada pesanan masuk.</p></div>
        @endif
    </div>

    <div class="panel">
        <h3>Paket Terpopuler</h3>
        @if($popularPackages->count() > 0)
            @foreach($popularPackages as $pkg)
                <div style="display:flex; justify-content:space-between; align-items:center; padding: 12px 0; border-bottom: 1px solid var(--line);">
                    <div>
                        <div style="font-weight:600; font-size:0.9rem;">{{ $pkg->package_name }}</div>
                        <div style="font-size:0.78rem; color:var(--ink-soft);">{{ $pkg->orders_count }} pesanan</div>
                    </div>
                    <span class="badge badge-primary">{{ $pkg->orders_count }}</span>
                </div>
            @endforeach
        @else
            <p class="form-hint">Belum ada data.</p>
        @endif
    </div>
</div>
@endsection
