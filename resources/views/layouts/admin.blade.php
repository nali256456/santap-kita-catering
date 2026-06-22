<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - SantapKita</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600;9..144,700;9..144,900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')
</head>
<body>
    <div class="dash-shell">
        <aside class="dash-sidebar" id="dashSidebar">
            <a href="{{ route('home') }}" class="brand">
                <img src="{{ asset('images/logo.png') }}" alt="SantapKita" class="brand-mark">
                <span class="brand-name">SantapKita</span>
            </a>
            <nav class="dash-nav">
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <span class="nav-icon">📊</span> Dashboard
                </a>
                <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <span class="nav-icon">🏷️</span> Kelola Kategori
                </a>
                <a href="{{ route('admin.packages.index') }}" class="{{ request()->routeIs('admin.packages.*') ? 'active' : '' }}">
                    <span class="nav-icon">🍱</span> Kelola Paket
                </a>
                <a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                    <span class="nav-icon">📋</span> Kelola Pesanan
                </a>
                <a href="{{ route('admin.payments.index') }}" class="{{ request()->routeIs('admin.payments.*') ? 'active' : '' }}">
                    <span class="nav-icon">💳</span> Kelola Pembayaran
                </a>
                <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <span class="nav-icon">👥</span> Kelola Pengguna
                </a>
                <a href="{{ route('admin.reports') }}" class="{{ request()->routeIs('admin.reports') ? 'active' : '' }}">
                    <span class="nav-icon">📈</span> Laporan
                </a>
                <div class="dash-nav-divider"></div>
                <a href="{{ route('home') }}">
                    <span class="nav-icon">🌐</span> Lihat Website
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" style="all:unset; display:flex; align-items:center; gap:12px; padding: 11px 14px; border-radius: 6px; font-size: 0.9rem; font-weight:600; color: rgba(250,243,231,0.65); cursor:pointer; width:100%;">
                        <span class="nav-icon">🚪</span> Keluar
                    </button>
                </form>
            </nav>
        </aside>

        <main class="dash-main">
            <div class="dash-topbar">
                <button id="sidebarToggle" class="btn btn-outline" style="display:none;">☰</button>
                <h1>@yield('page-title', 'Dashboard')</h1>
                <div class="dash-user-chip">
                    <div class="dash-user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                    <span>{{ auth()->user()->name }}</span>
                </div>
            </div>

            @if(session('success'))
                <div class="flash flash-success">✓ {{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="flash flash-error">⚠ {{ session('error') }}</div>
            @endif

            @yield('content')
        </main>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
