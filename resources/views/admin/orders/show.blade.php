@extends('layouts.admin')

@section('title', 'Detail Pesanan')
@section('page-title', 'Detail Pesanan #' . $order->id)

@section('content')
<div class="detail-grid" style="align-items:start;">
    <div class="panel">
        <div class="panel-head">
            <h3>Informasi Pesanan</h3>
            <span class="badge badge-{{ $order->status_badge }}">{{ $order->order_status }}</span>
        </div>
        <table class="data-table">
            <tr><td style="font-weight:600; width:40%;">Pelanggan</td><td>{{ $order->user->name }} ({{ $order->user->email }})</td></tr>
            <tr><td style="font-weight:600;">No. Telepon</td><td>{{ $order->user->phone ?? '-' }}</td></tr>
            <tr><td style="font-weight:600;">Paket</td><td>{{ $order->package->package_name }}</td></tr>
            <tr><td style="font-weight:600;">Kategori</td><td>{{ $order->package->category->category_name }}</td></tr>
            <tr><td style="font-weight:600;">Jumlah Porsi</td><td>{{ $order->quantity }} porsi</td></tr>
            <tr><td style="font-weight:600;">Tanggal Pesan</td><td>{{ $order->order_date->format('d F Y') }}</td></tr>
            <tr><td style="font-weight:600;">Tanggal Kirim</td><td>{{ $order->delivery_date->format('d F Y') }}</td></tr>
            <tr><td style="font-weight:600;">Alamat Kirim</td><td>{{ $order->delivery_address }}</td></tr>
            <tr><td style="font-weight:600;">Metode Bayar</td><td>Transfer Bank</td></tr>
            <tr><td style="font-weight:600;">Total Harga</td><td style="color: var(--clay); font-weight:700;">{{ $order->formatted_total_price }}</td></tr>
            @if($order->notes)
            <tr><td style="font-weight:600;">Catatan Pelanggan</td><td>{{ $order->notes }}</td></tr>
            @endif
        </table>
    </div>

    <div class="panel">
        <h3>Ubah Status Pesanan</h3>
        <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="order_status">Status Pesanan</label>
                <select id="order_status" name="order_status" class="form-control">
                    @foreach($statuses as $status)
                        <option value="{{ $status }}" {{ $order->order_status == $status ? 'selected' : '' }}>{{ $status }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Perbarui Status</button>
        </form>

        @if($order->payment)
            <div class="dash-nav-divider" style="border-color: var(--line); margin: 24px 0;"></div>
            <h3>Pembayaran</h3>
            <p><strong>Status Verifikasi:</strong> <span class="badge badge-{{ $order->payment->status_badge }}">{{ $order->payment->verification_status }}</span></p>
            <p><strong>Tanggal Bayar:</strong> {{ $order->payment->payment_date->format('d F Y') }}</p>
            @if($order->payment->proof_payment)
                <img src="{{ $order->payment->proof_payment_url }}" alt="Bukti Pembayaran" style="border-radius:8px; margin-top:10px; max-width:100%;">
            @endif
            <a href="{{ route('admin.payments.show', $order->payment) }}" class="btn btn-outline btn-block" style="margin-top:14px;">Verifikasi Pembayaran</a>
        @else
            <div class="dash-nav-divider" style="border-color: var(--line); margin: 24px 0;"></div>
            <p class="form-hint">Pelanggan belum mengunggah bukti pembayaran.</p>
        @endif
    </div>
</div>
@endsection
