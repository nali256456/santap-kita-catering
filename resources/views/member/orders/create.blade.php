@extends('layouts.app')

@section('title', 'Buat Pesanan')

@section('content')
<div class="page-banner">
    <div class="container">
        <h1>Buat Pesanan</h1>
        <p class="breadcrumb"><a href="{{ route('home') }}">Beranda</a> / <a href="{{ route('packages.show', $package) }}">{{ $package->package_name }}</a> / Buat Pesanan</p>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="detail-grid" style="align-items:start;">
            <div class="panel mb-0">
                <h3>{{ $package->package_name }}</h3>
                <div class="detail-img" style="aspect-ratio: 16/10; margin-bottom: 16px;">
                    @if($package->image)
                        <img src="{{ $package->image_url }}" alt="{{ $package->package_name }}">
                    @else
                        <span class="emoji-fallback">🍱</span>
                    @endif
                </div>
                <span class="detail-tag">{{ $package->category->category_name }}</span>
                <p class="detail-desc" style="margin-top:14px;">{{ $package->description }}</p>
                <div class="detail-price" style="font-size: 1.6rem;">{{ $package->formatted_price }} <span>/ porsi</span></div>
            </div>

            <div class="panel">
                <h3>Detail Pesanan</h3>
                <form action="{{ route('member.orders.store', $package) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="quantity">Jumlah Porsi</label>
                        <input type="number" id="quantityInput" name="quantity" class="form-control" value="{{ old('quantity', 1) }}" min="1" data-price="{{ $package->price }}">
                        @error('quantity')<span class="form-error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="delivery_date">Tanggal Pengiriman</label>
                        <input type="date" id="delivery_date" name="delivery_date" class="form-control" value="{{ old('delivery_date') }}" min="{{ now()->addDay()->toDateString() }}">
                        @error('delivery_date')<span class="form-error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="delivery_address">Alamat Pengiriman</label>
                        <textarea id="delivery_address" name="delivery_address" class="form-control" rows="3" placeholder="Alamat lengkap tujuan pengiriman">{{ old('delivery_address', auth()->user()->address) }}</textarea>
                        @error('delivery_address')<span class="form-error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label>Metode Pembayaran</label>
                        <div style="border:1.5px solid var(--line); padding:12px 16px; border-radius:8px; display:flex; align-items:center; gap:10px;">
                            <span style="font-size:1.2rem;">🏦</span>
                            <span style="font-weight:600;">Transfer Bank</span>
                        </div>
                        <input type="hidden" name="payment_method" value="transfer">
                        <span class="form-hint">Saat ini pembayaran hanya tersedia melalui transfer bank.</span>
                        @error('payment_method')<span class="form-error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="notes">Catatan (opsional)</label>
                        <textarea id="notes" name="notes" class="form-control" rows="2" placeholder="Catatan tambahan untuk pesanan Anda">{{ old('notes') }}</textarea>
                    </div>

                    <div class="panel" style="background: var(--cream-deep); padding: 16px 20px; margin-bottom: 20px;">
                        <div style="display:flex; justify-content:space-between; align-items:center;">
                            <span style="font-weight:600;">Total Harga</span>
                            <span id="totalPriceDisplay" style="font-family: var(--font-display); font-size: 1.4rem; font-weight:700; color: var(--clay);">{{ $package->formatted_price }}</span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Buat Pesanan</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
