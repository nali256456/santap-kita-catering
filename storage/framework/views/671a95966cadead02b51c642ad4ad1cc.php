<?php $__env->startSection('title', 'Beranda'); ?>

<?php $__env->startSection('content'); ?>
<section class="hero">
    <div class="container hero-inner">
        <div class="hero-copy">
            <span class="hero-eyebrow">🔥 Dimasak segar setiap hari</span>
            <h1>Catering andal untuk <em>setiap momen</em>, dari meja kantor hingga panggung hajatan.</h1>
            <p class="hero-sub">SantapKita menghadirkan paket nasi kotak harian, katering kantor, hingga prasmanan acara besar — dipesan online, diantar tepat waktu.</p>
            <div class="hero-cta">
                <a href="<?php echo e(route('packages.index')); ?>" class="btn btn-primary">Lihat Paket Catering</a>
                <a href="<?php echo e(route('about')); ?>" class="btn btn-outline">Tentang Kami</a>
            </div>
            <div class="hero-stats">
                <div class="hero-stat">
                    <span class="num"><?php echo e(\App\Models\Package::count()); ?>+</span>
                    <span class="label">Pilihan Paket</span>
                </div>
                <div class="hero-stat">
                    <span class="num">500+</span>
                    <span class="label">Pelanggan Puas</span>
                </div>
                <div class="hero-stat">
                    <span class="num">4</span>
                    <span class="label">Kategori Catering</span>
                </div>
            </div>
        </div>
        <div class="hero-visual">
            <div class="plate-stack">
                <div class="plate-ring"></div>
                <div class="plate-core"><img src="<?php echo e(asset('images/logo-hero.png')); ?>" alt="SantapKita"></div>
                <div class="float-badge top">✓ Bahan Segar</div>
                <div class="float-badge bottom">🚚 Antar Tepat Waktu</div>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head">
            <span class="section-eyebrow">Kategori</span>
            <h2>Pilih sesuai kebutuhan Anda</h2>
            <p>Dari kebutuhan harian sampai acara besar, kami punya paketnya.</p>
        </div>
        <div class="cat-grid">
            <?php
                $icons = ['Paket Harian' => '🍛', 'Paket Kantor' => '💼', 'Paket Acara' => '🎉', 'Paket Premium' => '👑'];
            ?>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('packages.index')); ?>?category=<?php echo e($cat->id); ?>" class="cat-card">
                    <div class="cat-icon"><?php echo e($icons[$cat->category_name] ?? '🍽️'); ?></div>
                    <h4><?php echo e($cat->category_name); ?></h4>
                    <span><?php echo e($cat->packages_count); ?> paket tersedia</span>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<section class="section section-alt">
    <div class="container">
        <div class="section-head">
            <span class="section-eyebrow">Paket Pilihan</span>
            <h2>Paket catering terbaru kami</h2>
            <p>Menu favorit yang dipilih langsung dari dapur SantapKita.</p>
        </div>
        <div class="pkg-grid">
            <?php $__currentLoopData = $featuredPackages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="pkg-card">
                    <div class="pkg-img">
                        <?php if($package->image): ?>
                            <img src="<?php echo e($package->image_url); ?>" alt="<?php echo e($package->package_name); ?>">
                        <?php else: ?>
                            <span class="emoji-fallback">🍱</span>
                        <?php endif; ?>
                        <span class="pkg-cat-tag"><?php echo e($package->category->category_name); ?></span>
                    </div>
                    <div class="pkg-body">
                        <h3><?php echo e($package->package_name); ?></h3>
                        <p class="pkg-desc"><?php echo e($package->description); ?></p>
                        <div class="pkg-footer">
                            <div class="pkg-price"><?php echo e($package->formatted_price); ?><br><small>per porsi</small></div>
                            <a href="<?php echo e(route('packages.show', $package)); ?>" class="btn btn-primary btn-sm">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="text-center" style="margin-top: 36px;">
            <a href="<?php echo e(route('packages.index')); ?>" class="btn btn-outline">Lihat Semua Paket</a>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head">
            <span class="section-eyebrow">Cara Pesan</span>
            <h2>Pesan catering hanya dalam 4 langkah</h2>
        </div>
        <div class="steps-grid">
            <div class="step-card">
                <span class="step-num">01</span>
                <h4>Pilih Paket</h4>
                <p>Telusuri katalog dan pilih paket sesuai kebutuhan dan budget Anda.</p>
            </div>
            <div class="step-card">
                <span class="step-num">02</span>
                <h4>Isi Detail Pesanan</h4>
                <p>Tentukan jumlah porsi, tanggal pengiriman, dan alamat tujuan.</p>
            </div>
            <div class="step-card">
                <span class="step-num">03</span>
                <h4>Lakukan Pembayaran</h4>
                <p>Lakukan pembayaran via transfer bank, lalu unggah bukti pembayaran.</p>
            </div>
            <div class="step-card">
                <span class="step-num">04</span>
                <h4>Pesanan Diantar</h4>
                <p>Pantau status pesanan hingga makanan tiba di lokasi Anda.</p>
            </div>
        </div>
    </div>
</section>

<?php if(auth()->guard()->guest()): ?>
<section class="section">
    <div class="container">
        <div class="cta-band">
            <div>
                <h2>Siap memesan catering untuk acara Anda?</h2>
                <p>Daftar sekarang dan nikmati kemudahan pemesanan catering online.</p>
            </div>
            <a href="<?php echo e(route('register')); ?>" class="btn btn-gold">Daftar Sekarang</a>
        </div>
    </div>
</section>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laravel10\santapkita\resources\views/guest/home.blade.php ENDPATH**/ ?>