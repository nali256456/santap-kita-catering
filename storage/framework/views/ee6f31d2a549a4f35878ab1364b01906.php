<?php $__env->startSection('title', 'Buat Pesanan'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-banner">
    <div class="container">
        <h1>Buat Pesanan</h1>
        <p class="breadcrumb"><a href="<?php echo e(route('home')); ?>">Beranda</a> / <a href="<?php echo e(route('packages.show', $package)); ?>"><?php echo e($package->package_name); ?></a> / Buat Pesanan</p>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="detail-grid" style="align-items:start;">
            <div class="panel mb-0">
                <h3><?php echo e($package->package_name); ?></h3>
                <div class="detail-img" style="aspect-ratio: 16/10; margin-bottom: 16px;">
                    <?php if($package->image): ?>
                        <img src="<?php echo e($package->image_url); ?>" alt="<?php echo e($package->package_name); ?>">
                    <?php else: ?>
                        <span class="emoji-fallback">🍱</span>
                    <?php endif; ?>
                </div>
                <span class="detail-tag"><?php echo e($package->category->category_name); ?></span>
                <p class="detail-desc" style="margin-top:14px;"><?php echo e($package->description); ?></p>
                <div class="detail-price" style="font-size: 1.6rem;"><?php echo e($package->formatted_price); ?> <span>/ porsi</span></div>
            </div>

            <div class="panel">
                <h3>Detail Pesanan</h3>
                <form action="<?php echo e(route('member.orders.store', $package)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="quantity">Jumlah Porsi</label>
                        <input type="number" id="quantityInput" name="quantity" class="form-control" value="<?php echo e(old('quantity', 1)); ?>" min="1" data-price="<?php echo e($package->price); ?>">
                        <?php $__errorArgs = ['quantity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="form-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group">
                        <label for="delivery_date">Tanggal Pengiriman</label>
                        <input type="date" id="delivery_date" name="delivery_date" class="form-control" value="<?php echo e(old('delivery_date')); ?>" min="<?php echo e(now()->addDay()->toDateString()); ?>">
                        <?php $__errorArgs = ['delivery_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="form-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group">
                        <label for="delivery_address">Alamat Pengiriman</label>
                        <textarea id="delivery_address" name="delivery_address" class="form-control" rows="3" placeholder="Alamat lengkap tujuan pengiriman"><?php echo e(old('delivery_address', auth()->user()->address)); ?></textarea>
                        <?php $__errorArgs = ['delivery_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="form-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group">
                        <label>Metode Pembayaran</label>
                        <div style="border:1.5px solid var(--line); padding:12px 16px; border-radius:8px; display:flex; align-items:center; gap:10px;">
                            <span style="font-size:1.2rem;">🏦</span>
                            <span style="font-weight:600;">Transfer Bank</span>
                        </div>
                        <input type="hidden" name="payment_method" value="transfer">
                        <span class="form-hint">Saat ini pembayaran hanya tersedia melalui transfer bank.</span>
                        <?php $__errorArgs = ['payment_method'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="form-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group">
                        <label for="notes">Catatan (opsional)</label>
                        <textarea id="notes" name="notes" class="form-control" rows="2" placeholder="Catatan tambahan untuk pesanan Anda"><?php echo e(old('notes')); ?></textarea>
                    </div>

                    <div class="panel" style="background: var(--cream-deep); padding: 16px 20px; margin-bottom: 20px;">
                        <div style="display:flex; justify-content:space-between; align-items:center;">
                            <span style="font-weight:600;">Total Harga</span>
                            <span id="totalPriceDisplay" style="font-family: var(--font-display); font-size: 1.4rem; font-weight:700; color: var(--clay);"><?php echo e($package->formatted_price); ?></span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Buat Pesanan</button>
                </form>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laravel10\santapkita\resources\views/member/orders/create.blade.php ENDPATH**/ ?>