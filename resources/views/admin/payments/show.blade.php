@extends('layouts.admin')

@section('title', 'Verifikasi Pembayaran')
@section('page-title', 'Verifikasi Pembayaran')

@section('content')
<div class="detail-grid" style="align-items:start;">
    <div class="panel">
        <h3>Bukti Pembayaran</h3>
        @if($payment->proof_payment)
            <img src="{{ $payment->proof_payment_url }}" alt="Bukti Pembayaran" style="border-radius:12px; width:100%; margin-top:10px;">
        @else
            <div class="empty-state"><div class="emoji">🧾</div><p>Belum ada bukti pembayaran yang diunggah.</p></div>
        @endif
    </div>

    <div>
        <div class="panel">
            <h3>Informasi Pesanan</h3>
            <table class="data-table">
                <tr><td style="font-weight:600; width:45%;">Pelanggan</td><td>{{ $payment->order->user->name }}</td></tr>
                <tr><td style="font-weight:600;">Paket</td><td>{{ $payment->order->package->package_name }}</td></tr>
                <tr><td style="font-weight:600;">Jumlah Porsi</td><td>{{ $payment->order->quantity }}</td></tr>
                <tr><td style="font-weight:600;">Total Harga</td><td style="color:var(--clay); font-weight:700;">{{ $payment->order->formatted_total_price }}</td></tr>
                <tr><td style="font-weight:600;">Tanggal Bayar</td><td>{{ $payment->payment_date->format('d F Y') }}</td></tr>
                <tr><td style="font-weight:600;">Status Saat Ini</td><td><span class="badge badge-{{ $payment->status_badge }}">{{ $payment->verification_status }}</span></td></tr>
            </table>
        </div>

        <div class="panel">
            <h3>Verifikasi Pembayaran</h3>
            <form action="{{ route('admin.payments.verify', $payment) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="verification_status">Status Verifikasi</label>
                    <select id="verification_status" name="verification_status" class="form-control">
                        <option value="Disetujui" {{ $payment->verification_status == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                        <option value="Ditolak" {{ $payment->verification_status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="notes">Catatan (opsional)</label>
                    <textarea id="notes" name="notes" class="form-control" rows="3" placeholder="Contoh: Nominal transfer tidak sesuai">{{ $payment->notes }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Simpan Verifikasi</button>
            </form>
        </div>
    </div>
</div>
@endsection
