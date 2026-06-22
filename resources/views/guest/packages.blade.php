@extends('layouts.app')

@section('title', 'Paket Catering')

@section('content')
<div class="page-banner">
    <div class="container">
        <h1>Paket Catering</h1>
        <p class="breadcrumb"><a href="{{ route('home') }}">Beranda</a> / Paket Catering</p>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="filter-bar">
            <form action="{{ route('packages.index') }}" method="GET">
                <input type="text" name="search" class="form-control" placeholder="Cari paket catering..." value="{{ $search }}">
                @if($categoryId)
                    <input type="hidden" name="category" value="{{ $categoryId }}">
                @endif
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>
        </div>

        <div class="cat-chips" style="margin-bottom: 30px;">
            <a href="{{ route('packages.index') }}" class="cat-chip {{ !$categoryId ? 'active' : '' }}">Semua</a>
            @foreach($categories as $cat)
                <a href="{{ route('packages.index') }}?category={{ $cat->id }}" class="cat-chip {{ $categoryId == $cat->id ? 'active' : '' }}">{{ $cat->category_name }}</a>
            @endforeach
        </div>

        @if($packages->count() > 0)
            <div class="pkg-grid">
                @foreach($packages as $package)
                    <div class="pkg-card">
                        <div class="pkg-img">
                            @if($package->image)
                                <img src="{{ $package->image_url }}" alt="{{ $package->package_name }}">
                            @else
                                <span class="emoji-fallback">🍱</span>
                            @endif
                            <span class="pkg-cat-tag">{{ $package->category->category_name }}</span>
                        </div>
                        <div class="pkg-body">
                            <h3>{{ $package->package_name }}</h3>
                            <p class="pkg-desc">{{ $package->description }}</p>
                            <div class="pkg-footer">
                                <div class="pkg-price">{{ $package->formatted_price }}<br><small>per porsi</small></div>
                                <a href="{{ route('packages.show', $package) }}" class="btn btn-primary btn-sm">Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="pagination-wrap">
                {{ $packages->links() }}
            </div>
        @else
            <div class="empty-state">
                <div class="emoji">🔍</div>
                <h3>Paket tidak ditemukan</h3>
                <p>Coba kata kunci atau kategori lain.</p>
            </div>
        @endif
    </div>
</section>
@endsection
