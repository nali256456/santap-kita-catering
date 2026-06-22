@extends('layouts.app')

@section('title', 'Riwayat Pesanan')

@section('content')
<div class="page-banner">
    <div class="container">
        <h1>Riwayat Pesanan</h1>
        <p class="breadcrumb"><a href="{{ route('home') }}">Beranda</a> / Riwayat Pesanan</p>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="panel">
            @if($orders->count() > 0)
                <div class="table-wrap">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Paket</th>
                                <th>Porsi</th>
                                <th>Tgl Kirim</th>
                                <th>Total</th>
                                <th>Pembayaran</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->package->package_name }}</td>
                                    <td>{{ $order->quantity }}</td>
                                    <td>{{ $order->delivery_date->format('d M Y') }}</td>
                                    <td>{{ $order->formatted_total_price }}</td>
                                    <td>Transfer Bank</td>
                                    <td><span class="badge badge-{{ $order->status_badge }}">{{ $order->order_status }}</span></td>
                                    <td><a href="{{ route('member.orders.show', $order) }}" class="btn btn-outline btn-sm">Detail</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="pagination-wrap">{{ $orders->links() }}</div>
            @else
                <div class="empty-state">
                    <div class="emoji">📭</div>
                    <h3>Belum ada pesanan</h3>
                    <p>Yuk mulai pesan paket catering favorit Anda.</p>
                    <a href="{{ route('packages.index') }}" class="btn btn-primary" style="margin-top:14px;">Lihat Paket</a>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection
