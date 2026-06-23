<?php $__env->startSection('title', $package->package_name); ?>

<?php $__env->startSection('content'); ?>
<div class="page-banner">
    <div class="container">
        <h1><?php echo e($package->package_name); ?></h1>
        <p class="breadcrumb"><a href="<?php echo e(route('home')); ?>">Beranda</a> / <a href="<?php echo e(route('packages.index')); ?>">Paket Catering</a> / <?php echo e($package->package_name); ?></p>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="detail-grid">
            <div class="detail-img">
                <?php if($package->image): ?>
                    <img src="<?php echo e($package->image_url); ?>" alt="<?php echo e($package->package_name); ?>">
                <?php else: ?>
                    <span class="emoji-fallback">🍱</span>
                <?php endif; ?>
            </div>
            <div class="detail-info">
                <span class="detail-tag"><?php echo e($package->category->category_name); ?></span>
                <h1 style="margin-bottom: 6px;"><?php echo e($package->package_name); ?></h1>
                <div class="detail-price"><?php echo e($package->formatted_price); ?> <span>/ porsi</span></div>
                <p class="detail-desc"><?php echo e($package->description); ?></p>

                <div class="detail-meta">
                    <div class="detail-meta-item">📦 Min. 1 porsi</div>
                    <div class="detail-meta-item">🚚 Pengiriman fleksibel</div>
                    <div class="detail-meta-item">💳 Pembayaran Transfer Bank</div>
                </div>

                <?php if(auth()->guard()->check()): ?>
                    <?php if(auth()->user()->isMember()): ?>
                        <a href="<?php echo e(route('member.orders.create', $package)); ?>" class="btn btn-primary btn-block">Pesan Sekarang</a>
                    <?php else: ?>
                        <p class="form-hint">Masuk sebagai pelanggan untuk memesan paket ini.</p>
                    <?php endif; ?>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="btn btn-primary btn-block">Masuk untuk Memesan</a>
                    <p class="auth-footer mt-0">Belum punya akun? <a href="<?php echo e(route('register')); ?>">Daftar di sini</a></p>
                <?php endif; ?>
            </div>
        </div>

        <?php if($related->count() > 0): ?>
            <div class="section-head" style="margin-top: 70px;">
                <span class="section-eyebrow">Lainnya</span>
                <h2>Paket Serupa</h2>
            </div>
            <div class="pkg-grid">
                <?php $__currentLoopData = $related; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="pkg-card">
                        <div class="pkg-img">
                            <?php if($rel->image): ?>
                                <img src="<?php echo e($rel->image_url); ?>" alt="<?php echo e($rel->package_name); ?>">
                            <?php else: ?>
                                <span class="emoji-fallback">🍱</span>
                            <?php endif; ?>
                            <span class="pkg-cat-tag"><?php echo e($rel->category->category_name); ?></span>
                        </div>
                        <div class="pkg-body">
                            <h3><?php echo e($rel->package_name); ?></h3>
                            <p class="pkg-desc"><?php echo e($rel->description); ?></p>
                            <div class="pkg-footer">
                                <div class="pkg-price"><?php echo e($rel->formatted_price); ?><br><small>per porsi</small></div>
                                <a href="<?php echo e(route('packages.show', $rel)); ?>" class="btn btn-primary btn-sm">Detail</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laravel10\santapkita\resources\views/guest/package-detail.blade.php ENDPATH**/ ?>