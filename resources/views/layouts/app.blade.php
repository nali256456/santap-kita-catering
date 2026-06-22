<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SantapKita') - Catering Terpercaya</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600;9..144,700;9..144,900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')
</head>
<body>
    <div class="topbar">
        <div class="container topbar-inner">
            <span>🍱 Pesan catering harian, kantor, hingga acara besar</span>
            <span class="topbar-phone">Telp/WA: 0812-0000-0000</span>
        </div>
    </div>

    <header class="site-header">
        <div class="container header-inner">
            <a href="{{ route('home') }}" class="brand">
                <img src="{{ asset('images/logo.png') }}" alt="SantapKita" class="brand-mark">
                <span class="brand-name">SantapKita</span>
            </a>

            <nav class="main-nav" id="mainNav">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
                <a href="{{ route('packages.index') }}" class="{{ request()->routeIs('packages.*') ? 'active' : '' }}">Paket Catering</a>
                <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">Tentang Kami</a>
            </nav>

            <div class="header-actions">
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-ghost">Dashboard Admin</a>
                        <form action="{{ route('logout') }}" method="POST" class="inline-form">
                            @csrf
                            <button type="submit" class="btn btn-outline">Keluar</button>
                        </form>
                    @else
                        <div class="user-menu">
                            <button type="button" class="user-menu-trigger" id="userMenuTrigger">
                                <span class="dash-user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                                <span>{{ explode(' ', auth()->user()->name)[0] }}</span>
                                <span class="caret">▾</span>
                            </button>
                            <div class="user-menu-dropdown" id="userMenuDropdown">
                                <a href="{{ route('member.orders.index') }}">📋 Riwayat Pesanan</a>
                                <a href="{{ route('member.profile') }}">👤 Profil Saya</a>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit">🚪 Keluar</button>
                                </form>
                            </div>
                        </div>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn btn-ghost">Masuk</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">Daftar</a>
                @endauth
            </div>

            <button class="nav-toggle" id="navToggle" aria-label="Buka menu">
                <span></span><span></span><span></span>
            </button>
        </div>
    </header>

    @if(session('success'))
        <div class="flash flash-success container">
            <span>✓ {{ session('success') }}</span>
        </div>
    @endif
    @if(session('error'))
        <div class="flash flash-error container">
            <span>⚠ {{ session('error') }}</span>
        </div>
    @endif

    <main>
        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="container footer-grid">
            <div class="footer-brand">
                <div class="brand">
                    <img src="{{ asset('images/logo.png') }}" alt="SantapKita" class="brand-mark">
                    <span class="brand-name">SantapKita</span>
                </div>
                <p>Mitra catering harian, kantor, acara, dan kebutuhan premium Anda — dimasak segar, diantar tepat waktu.</p>
            </div>
            <div class="footer-col">
                <h4>Jelajahi</h4>
                <a href="{{ route('packages.index') }}">Paket Catering</a>
                <a href="{{ route('about') }}">Tentang Kami</a>
            </div>
            <div class="footer-col">
                <h4>Kategori</h4>
                <a href="{{ route('packages.index') }}?category=1">Paket Harian</a>
                <a href="{{ route('packages.index') }}?category=2">Paket Kantor</a>
                <a href="{{ route('packages.index') }}?category=3">Paket Acara</a>
                <a href="{{ route('packages.index') }}?category=4">Paket Premium</a>
            </div>
            <div class="footer-col">
                <h4>Hubungi Kami</h4>
                <p>Jl. Dapur Nusantara No. 12<br>Depok, Jawa Barat</p>
                <p>0812-0000-0000<br>halo@santapkita.com</p>
            </div>
        </div>
        <div class="footer-bottom container">
            <p>&copy; {{ date('Y') }} SantapKita. Semua hak dilindungi.</p>
        </div>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
