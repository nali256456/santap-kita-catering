@extends('layouts.app')

@section('title', $package->package_name)

@section('content')
<div class="page-banner">
    <div class="container">
        <h1>{{ $package->package_name }}</h1>
        <p class="breadcrumb"><a href="{{ route('home') }}">Beranda</a> / <a href="{{ route('packages.index') }}">Paket Catering</a> / {{ $package->package_name }}</p>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="detail-grid">
            <div class="detail-img">
                @if($package->image)
                    <img src="{{ $package->image_url }}" alt="{{ $package->package_name }}">
                @else
                    <span class="emoji-fallback">🍱</span>
                @endif
            </div>
            <div class="detail-info">
                <span class="detail-tag">{{ $package->category->category_name }}</span>
                <h1 style="margin-bottom: 6px;">{{ $package->package_name }}</h1>
                <div class="detail-price">{{ $package->formatted_price }} <span>/ porsi</span></div>
                <p class="detail-desc">{{ $package->description }}</p>

                <div class="detail-meta">
                    <div class="detail-meta-item">📦 Min. 1 porsi</div>
                    <div class="detail-meta-item">🚚 Pengiriman fleksibel</div>
                    <div class="detail-meta-item">💳 Pembayaran Transfer Bank</div>
                </div>

                @auth
                    @if(auth()->user()->isMember())
                        <a href="{{ route('member.orders.create', $package) }}" class="btn btn-primary btn-block">Pesan Sekarang</a>
                    @else
                        <p class="form-hint">Masuk sebagai pelanggan untuk memesan paket ini.</p>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary btn-block">Masuk untuk Memesan</a>
                    <p class="auth-footer mt-0">Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
                @endauth
            </div>
        </div>

        @if($related->count() > 0)
            <div class="section-head" style="margin-top: 70px;">
                <span class="section-eyebrow">Lainnya</span>
                <h2>Paket Serupa</h2>
            </div>
            <div class="pkg-grid">
                @foreach($related as $rel)
                    <div class="pkg-card">
                        <div class="pkg-img">
                            @if($rel->image)
                                <img src="{{ $rel->image_url }}" alt="{{ $rel->package_name }}">
                            @else
                                <span class="emoji-fallback">🍱</span>
                            @endif
                            <span class="pkg-cat-tag">{{ $rel->category->category_name }}</span>
                        </div>
                        <div class="pkg-body">
                            <h3>{{ $rel->package_name }}</h3>
                            <p class="pkg-desc">{{ $rel->description }}</p>
                            <div class="pkg-footer">
                                <div class="pkg-price">{{ $rel->formatted_price }}<br><small>per porsi</small></div>
                                <a href="{{ route('packages.show', $rel) }}" class="btn btn-primary btn-sm">Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection
