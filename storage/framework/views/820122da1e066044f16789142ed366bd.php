<?php $__env->startSection('title', 'Paket Catering'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-banner">
    <div class="container">
        <h1>Paket Catering</h1>
        <p class="breadcrumb"><a href="<?php echo e(route('home')); ?>">Beranda</a> / Paket Catering</p>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="filter-bar">
            <form action="<?php echo e(route('packages.index')); ?>" method="GET">
                <input type="text" name="search" class="form-control" placeholder="Cari paket catering..." value="<?php echo e($search); ?>">
                <?php if($categoryId): ?>
                    <input type="hidden" name="category" value="<?php echo e($categoryId); ?>">
                <?php endif; ?>
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>
        </div>

        <div class="cat-chips" style="margin-bottom: 30px;">
            <a href="<?php echo e(route('packages.index')); ?>" class="cat-chip <?php echo e(!$categoryId ? 'active' : ''); ?>">Semua</a>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('packages.index')); ?>?category=<?php echo e($cat->id); ?>" class="cat-chip <?php echo e($categoryId == $cat->id ? 'active' : ''); ?>"><?php echo e($cat->category_name); ?></a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <?php if($packages->count() > 0): ?>
            <div class="pkg-grid">
                <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                                <a href="<?php echo e(route('packages.show', $package)); ?>" class="btn btn-primary btn-sm">Detail</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="pagination-wrap">
                <?php echo e($packages->links()); ?>

            </div>
        <?php else: ?>
            <div class="empty-state">
                <div class="emoji">🔍</div>
                <h3>Paket tidak ditemukan</h3>
                <p>Coba kata kunci atau kategori lain.</p>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laravel10\santapkita\resources\views/guest/packages.blade.php ENDPATH**/ ?>