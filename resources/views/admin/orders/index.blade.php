@extends('layouts.admin')

@section('title', 'Kelola Pesanan')
@section('page-title', 'Kelola Pesanan')

@section('content')
<div class="panel">
    <div class="panel-head">
        <h3>Daftar Pesanan</h3>
    </div>

    <form action="{{ route('admin.orders.index') }}" method="GET" class="filter-bar">
        <input type="text" name="search" class="form-control" placeholder="Cari nama pelanggan..." value="{{ request('search') }}">
        <select name="status" class="form-control" onchange="this.form.submit()">
            <option value="">Semua Status</option>
            @foreach($statuses as $status)
                <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>{{ $status }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

    @if($orders->count() > 0)
        <div class="table-wrap">
            <table class="data-table">
                <thead>
                    <tr><th>Pelanggan</th><th>Paket</th><th>Porsi</th><th>Tgl Kirim</th><th>Total</th><th>Bayar</th><th>Status</th><th></th></tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $order->package->package_name }}</td>
                            <td>{{ $order->quantity }}</td>
                            <td>{{ $order->delivery_date->format('d M Y') }}</td>
                            <td>{{ $order->formatted_total_price }}</td>
                            <td>Transfer</td>
                            <td><span class="badge badge-{{ $order->status_badge }}">{{ $order->order_status }}</span></td>
                            <td><a href="{{ route('admin.orders.show', $order) }}" class="btn btn-outline btn-sm">Kelola</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination-wrap">{{ $orders->links() }}</div>
    @else
        <div class="empty-state"><div class="emoji">📭</div><p>Belum ada pesanan.</p></div>
    @endif
</div>
@endsection
