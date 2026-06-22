@extends('layouts.app')

@section('title', 'Detail Pesanan')

@section('content')
@php
    $statusOrder = ['Menunggu Pembayaran', 'Menunggu Verifikasi', 'Diproses', 'Dikirim', 'Selesai'];
    $currentIndex = array_search($order->order_status, $statusOrder);
@endphp

<div class="page-banner">
    <div class="container">
        <h1>Detail Pesanan #{{ $order->id }}</h1>
        <p class="breadcrumb"><a href="{{ route('home') }}">Beranda</a> / <a href="{{ route('member.orders.index') }}">Riwayat Pesanan</a> / #{{ $order->id }}</p>
    </div>
</div>

<section class="section">
    <div class="container">
        @if($order->order_status !== 'Dibatalkan')
        <div class="panel">
            <div class="order-timeline">
                @foreach($statusOrder as $i => $status)
                    <div class="timeline-step {{ $i < $currentIndex ? 'done' : ($i == $currentIndex ? 'current' : '') }}">
                        <div class="timeline-dot">{{ $i < $currentIndex ? '✓' : ($i+1) }}</div>
                        <span class="label">{{ $status }}</span>
                    </div>
                @endforeach
            </div>
        </div>
        @else
        <div class="flash flash-error">⚠ Pesanan ini telah dibatalkan.</div>
        @endif

        <div class="detail-grid" style="align-items:start;">
            <div class="panel">
                <div class="panel-head">
                    <h3>Informasi Pesanan</h3>
                    <span class="badge badge-{{ $order->status_badge }}">{{ $order->order_status }}</span>
                </div>
                <table class="data-table">
                    <tr><td style="font-weight:600; width:40%;">Paket</td><td>{{ $order->package->package_name }}</td></tr>
                    <tr><td style="font-weight:600;">Kategori</td><td>{{ $order->package->category->category_name }}</td></tr>
                    <tr><td style="font-weight:600;">Jumlah Porsi</td><td>{{ $order->quantity }} porsi</td></tr>
                    <tr><td style="font-weight:600;">Tanggal Pesan</td><td>{{ $order->order_date->format('d F Y') }}</td></tr>
                    <tr><td style="font-weight:600;">Tanggal Kirim</td><td>{{ $order->delivery_date->format('d F Y') }}</td></tr>
                    <tr><td style="font-weight:600;">Alamat Kirim</td><td>{{ $order->delivery_address }}</td></tr>
                    <tr><td style="font-weight:600;">Metode Bayar</td><td>Transfer Bank</td></tr>
                    <tr><td style="font-weight:600;">Total Harga</td><td style="color: var(--clay); font-weight:700;">{{ $order->formatted_total_price }}</td></tr>
                    @if($order->notes)
                    <tr><td style="font-weight:600;">Catatan</td><td>{{ $order->notes }}</td></tr>
                    @endif
                </table>

                @if($order->canBeCancelled())
                    <form action="{{ route('member.orders.cancel', $order) }}" method="POST" data-confirm="Yakin ingin membatalkan pesanan ini?" style="margin-top: 20px;">
                        @csrf
                        <button type="submit" class="btn btn-danger">Batalkan Pesanan</button>
                    </form>
                @endif
            </div>

            <div class="panel">
                <h3>Pembayaran</h3>

                @if($order->order_status === 'Menunggu Pembayaran')
                    <p class="form-hint" style="margin-bottom:16px;">Silakan transfer ke rekening berikut, lalu unggah bukti pembayaran:</p>
                    <div class="panel" style="background: var(--cream-deep);">
                        <strong>Bank BCA</strong><br>
                        No. Rekening: 1234567890<br>
                        A/N: SantapKita Catering
                    </div>

                    <form action="{{ route('member.orders.upload-payment', $order) }}" method="POST" enctype="multipart/form-data" style="margin-top:20px;">
                        @csrf
                        <div class="form-group">
                            <label for="proof_payment">Unggah Bukti Pembayaran</label>
                            <input type="file" id="proof_payment" name="proof_payment" class="form-control" accept="image/*" data-preview="previewImg">
                            @error('proof_payment')<span class="form-error">{{ $message }}</span>@enderror
                            <img id="previewImg" style="display:none; margin-top:10px; border-radius:8px; max-height:200px;">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Unggah Bukti Pembayaran</button>
                    </form>
                @elseif($order->payment)
                    <p><strong>Status Verifikasi:</strong> <span class="badge badge-{{ $order->payment->status_badge }}">{{ $order->payment->verification_status }}</span></p>
                    <p><strong>Tanggal Bayar:</strong> {{ $order->payment->payment_date->format('d F Y') }}</p>
                    @if($order->payment->proof_payment)
                        <img src="{{ $order->payment->proof_payment_url }}" alt="Bukti Pembayaran" style="border-radius:8px; margin-top:10px; max-width:100%;">
                    @endif
                    @if($order->payment->notes)
                        <p style="margin-top:12px;"><strong>Catatan Admin:</strong> {{ $order->payment->notes }}</p>
                    @endif
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
