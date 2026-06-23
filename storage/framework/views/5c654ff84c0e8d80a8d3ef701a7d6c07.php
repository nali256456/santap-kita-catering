<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Admin'); ?> - SantapKita</title>
    <link rel="icon" type="image/png" href="<?php echo e(asset('images/logo.png')); ?>">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600;9..144,700;9..144,900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
    <div class="dash-shell">
        <aside class="dash-sidebar" id="dashSidebar">
            <a href="<?php echo e(route('home')); ?>" class="brand">
                <img src="<?php echo e(asset('images/logo.png')); ?>" alt="SantapKita" class="brand-mark">
                <span class="brand-name">SantapKita</span>
            </a>
            <nav class="dash-nav">
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="<?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
                    <span class="nav-icon">📊</span> Dashboard
                </a>
                <a href="<?php echo e(route('admin.categories.index')); ?>" class="<?php echo e(request()->routeIs('admin.categories.*') ? 'active' : ''); ?>">
                    <span class="nav-icon">🏷️</span> Kelola Kategori
                </a>
                <a href="<?php echo e(route('admin.packages.index')); ?>" class="<?php echo e(request()->routeIs('admin.packages.*') ? 'active' : ''); ?>">
                    <span class="nav-icon">🍱</span> Kelola Paket
                </a>
                <a href="<?php echo e(route('admin.orders.index')); ?>" class="<?php echo e(request()->routeIs('admin.orders.*') ? 'active' : ''); ?>">
                    <span class="nav-icon">📋</span> Kelola Pesanan
                </a>
                <a href="<?php echo e(route('admin.payments.index')); ?>" class="<?php echo e(request()->routeIs('admin.payments.*') ? 'active' : ''); ?>">
                    <span class="nav-icon">💳</span> Kelola Pembayaran
                </a>
                <a href="<?php echo e(route('admin.users.index')); ?>" class="<?php echo e(request()->routeIs('admin.users.*') ? 'active' : ''); ?>">
                    <span class="nav-icon">👥</span> Kelola Pengguna
                </a>
                <a href="<?php echo e(route('admin.reports')); ?>" class="<?php echo e(request()->routeIs('admin.reports') ? 'active' : ''); ?>">
                    <span class="nav-icon">📈</span> Laporan
                </a>
                <div class="dash-nav-divider"></div>
                <a href="<?php echo e(route('home')); ?>">
                    <span class="nav-icon">🌐</span> Lihat Website
                </a>
                <form action="<?php echo e(route('logout')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" style="all:unset; display:flex; align-items:center; gap:12px; padding: 11px 14px; border-radius: 6px; font-size: 0.9rem; font-weight:600; color: rgba(250,243,231,0.65); cursor:pointer; width:100%;">
                        <span class="nav-icon">🚪</span> Keluar
                    </button>
                </form>
            </nav>
        </aside>

        <main class="dash-main">
            <div class="dash-topbar">
                <button id="sidebarToggle" class="btn btn-outline" style="display:none;">☰</button>
                <h1><?php echo $__env->yieldContent('page-title', 'Dashboard'); ?></h1>
                <div class="dash-user-chip">
                    <div class="dash-user-avatar"><?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?></div>
                    <span><?php echo e(auth()->user()->name); ?></span>
                </div>
            </div>

            <?php if(session('success')): ?>
                <div class="flash flash-success">✓ <?php echo e(session('success')); ?></div>
            <?php endif; ?>
            <?php if(session('error')): ?>
                <div class="flash flash-error">⚠ <?php echo e(session('error')); ?></div>
            <?php endif; ?>

            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>

    <script src="<?php echo e(asset('js/app.js')); ?>"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\laravel10\santapkita\resources\views/layouts/admin.blade.php ENDPATH**/ ?>