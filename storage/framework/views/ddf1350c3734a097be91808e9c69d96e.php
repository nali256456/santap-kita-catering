<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'SantapKita'); ?> - Catering Terpercaya</title>
    <link rel="icon" type="image/png" href="<?php echo e(asset('images/logo.png')); ?>">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600;9..144,700;9..144,900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
    <?php echo $__env->yieldPushContent('styles'); ?>
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
            <a href="<?php echo e(route('home')); ?>" class="brand">
                <img src="<?php echo e(asset('images/logo.png')); ?>" alt="SantapKita" class="brand-mark">
                <span class="brand-name">SantapKita</span>
            </a>

            <nav class="main-nav" id="mainNav">
                <a href="<?php echo e(route('home')); ?>" class="<?php echo e(request()->routeIs('home') ? 'active' : ''); ?>">Beranda</a>
                <a href="<?php echo e(route('packages.index')); ?>" class="<?php echo e(request()->routeIs('packages.*') ? 'active' : ''); ?>">Paket Catering</a>
                <a href="<?php echo e(route('about')); ?>" class="<?php echo e(request()->routeIs('about') ? 'active' : ''); ?>">Tentang Kami</a>
            </nav>

            <div class="header-actions">
                <?php if(auth()->guard()->check()): ?>
                    <?php if(auth()->user()->isAdmin()): ?>
                        <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-ghost">Dashboard Admin</a>
                        <form action="<?php echo e(route('logout')); ?>" method="POST" class="inline-form">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-outline">Keluar</button>
                        </form>
                    <?php else: ?>
                        <div class="user-menu">
                            <button type="button" class="user-menu-trigger" id="userMenuTrigger">
                                <span class="dash-user-avatar"><?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?></span>
                                <span><?php echo e(explode(' ', auth()->user()->name)[0]); ?></span>
                                <span class="caret">▾</span>
                            </button>
                            <div class="user-menu-dropdown" id="userMenuDropdown">
                                <a href="<?php echo e(route('member.orders.index')); ?>">📋 Riwayat Pesanan</a>
                                <a href="<?php echo e(route('member.profile')); ?>">👤 Profil Saya</a>
                                <form action="<?php echo e(route('logout')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit">🚪 Keluar</button>
                                </form>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="btn btn-ghost">Masuk</a>
                    <a href="<?php echo e(route('register')); ?>" class="btn btn-primary">Daftar</a>
                <?php endif; ?>
            </div>

            <button class="nav-toggle" id="navToggle" aria-label="Buka menu">
                <span></span><span></span><span></span>
            </button>
        </div>
    </header>

    <?php if(session('success')): ?>
        <div class="flash flash-success container">
            <span>✓ <?php echo e(session('success')); ?></span>
        </div>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <div class="flash flash-error container">
            <span>⚠ <?php echo e(session('error')); ?></span>
        </div>
    <?php endif; ?>

    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <footer class="site-footer">
        <div class="container footer-grid">
            <div class="footer-brand">
                <div class="brand">
                    <img src="<?php echo e(asset('images/logo.png')); ?>" alt="SantapKita" class="brand-mark">
                    <span class="brand-name">SantapKita</span>
                </div>
                <p>Mitra catering harian, kantor, acara, dan kebutuhan premium Anda — dimasak segar, diantar tepat waktu.</p>
            </div>
            <div class="footer-col">
                <h4>Jelajahi</h4>
                <a href="<?php echo e(route('packages.index')); ?>">Paket Catering</a>
                <a href="<?php echo e(route('about')); ?>">Tentang Kami</a>
            </div>
            <div class="footer-col">
                <h4>Kategori</h4>
                <a href="<?php echo e(route('packages.index')); ?>?category=1">Paket Harian</a>
                <a href="<?php echo e(route('packages.index')); ?>?category=2">Paket Kantor</a>
                <a href="<?php echo e(route('packages.index')); ?>?category=3">Paket Acara</a>
                <a href="<?php echo e(route('packages.index')); ?>?category=4">Paket Premium</a>
            </div>
            <div class="footer-col">
                <h4>Hubungi Kami</h4>
                <p>Jl. Dapur Nusantara No. 12<br>Depok, Jawa Barat</p>
                <p>0812-0000-0000<br>halo@santapkita.com</p>
            </div>
        </div>
        <div class="footer-bottom container">
            <p>&copy; <?php echo e(date('Y')); ?> SantapKita. Semua hak dilindungi.</p>
        </div>
    </footer>

    <script src="<?php echo e(asset('js/app.js')); ?>"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\laravel10\santapkita\resources\views/layouts/app.blade.php ENDPATH**/ ?>