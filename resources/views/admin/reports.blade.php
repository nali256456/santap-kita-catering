@extends('layouts.admin')

@section('title', 'Laporan')
@section('page-title', 'Laporan Pemesanan')

@section('content')
<div class="panel">
    <form action="{{ route('admin.reports') }}" method="GET" class="filter-bar">
        <div class="form-group mb-0" style="flex:1; min-width:160px;">
            <label>Dari Tanggal</label>
            <input type="date" name="start_date" class="form-control" value="{{ $startDate }}">
        </div>
        <div class="form-group mb-0" style="flex:1; min-width:160px;">
            <label>Sampai Tanggal</label>
            <input type="date" name="end_date" class="form-control" value="{{ $endDate }}">
        </div>
        <button type="submit" class="btn btn-primary" style="align-self:flex-end;">Tampilkan</button>
    </form>
</div>

<div class="stat-grid">
    <div class="stat-card">
        <div class="stat-icon">📋</div>
        <div class="stat-val">{{ $summary['total_orders'] }}</div>
        <div class="stat-label">Total Pesanan</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon">💰</div>
        <div class="stat-val">Rp {{ number_format($summary['total_revenue'], 0, ',', '.') }}</div>
        <div class="stat-label">Pendapatan (Selesai)</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon">⏳</div>
        <div class="stat-val">{{ $summary['total_pending'] }}</div>
        <div class="stat-label">Menunggu Proses</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon">❌</div>
        <div class="stat-val">{{ $summary['total_cancelled'] }}</div>
        <div class="stat-label">Dibatalkan</div>
    </div>
</div>

<div class="panel">
    <div class="panel-head"><h3>Penjualan per Paket</h3></div>
    @if($packageSales->count() > 0)
        <div class="table-wrap">
            <table class="data-table">
                <thead><tr><th>Paket</th><th>Total Porsi Terjual</th><th>Total Pendapatan</th></tr></thead>
                <tbody>
                    @foreach($packageSales as $sale)
                        <tr>
                            <td>{{ $sale->package->package_name ?? '-' }}</td>
                            <td>{{ $sale->total_qty }}</td>
                            <td>Rp {{ number_format($sale->total_revenue, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="empty-state"><div class="emoji">📊</div><p>Tidak ada data pada rentang tanggal ini.</p></div>
    @endif
</div>

<div class="panel">
    <div class="panel-head"><h3>Daftar Pesanan</h3></div>
    @if($orders->count() > 0)
        <div class="table-wrap">
            <table class="data-table">
                <thead><tr><th>Pelanggan</th><th>Paket</th><th>Tgl Pesan</th><th>Total</th><th>Status</th></tr></thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $order->package->package_name }}</td>
                            <td>{{ $order->order_date->format('d M Y') }}</td>
                            <td>{{ $order->formatted_total_price }}</td>
                            <td><span class="badge badge-{{ $order->status_badge }}">{{ $order->order_status }}</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="empty-state"><div class="emoji">📭</div><p>Tidak ada pesanan pada rentang tanggal ini.</p></div>
    @endif
</div>
@endsection
