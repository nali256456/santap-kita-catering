@extends('layouts.admin')

@section('title', 'Kelola Pembayaran')
@section('page-title', 'Kelola Pembayaran')

@section('content')
<div class="panel">
    <div class="panel-head">
        <h3>Daftar Pembayaran</h3>
    </div>

    <form action="{{ route('admin.payments.index') }}" method="GET" class="filter-bar">
        <select name="status" class="form-control" onchange="this.form.submit()">
            <option value="">Semua Status</option>
            <option value="Menunggu" {{ request('status') == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
            <option value="Disetujui" {{ request('status') == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
            <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
        </select>
    </form>

    @if($payments->count() > 0)
        <div class="table-wrap">
            <table class="data-table">
                <thead>
                    <tr><th>Pelanggan</th><th>Paket</th><th>Total</th><th>Tgl Bayar</th><th>Status</th><th></th></tr>
                </thead>
                <tbody>
                    @foreach($payments as $payment)
                        <tr>
                            <td>{{ $payment->order->user->name }}</td>
                            <td>{{ $payment->order->package->package_name }}</td>
                            <td>{{ $payment->order->formatted_total_price }}</td>
                            <td>{{ $payment->payment_date->format('d M Y') }}</td>
                            <td><span class="badge badge-{{ $payment->status_badge }}">{{ $payment->verification_status }}</span></td>
                            <td><a href="{{ route('admin.payments.show', $payment) }}" class="btn btn-outline btn-sm">Verifikasi</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination-wrap">{{ $payments->links() }}</div>
    @else
        <div class="empty-state"><div class="emoji">💳</div><p>Belum ada data pembayaran.</p></div>
    @endif
</div>
@endsection
