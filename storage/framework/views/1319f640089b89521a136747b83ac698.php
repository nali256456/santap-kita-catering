<?php $__env->startSection('title', 'Detail Pesanan'); ?>

<?php $__env->startSection('content'); ?>
<?php
    $statusOrder = ['Menunggu Pembayaran', 'Menunggu Verifikasi', 'Diproses', 'Dikirim', 'Selesai'];
    $currentIndex = array_search($order->order_status, $statusOrder);
?>

<div class="page-banner">
    <div class="container">
        <h1>Detail Pesanan #<?php echo e($order->id); ?></h1>
        <p class="breadcrumb"><a href="<?php echo e(route('home')); ?>">Beranda</a> / <a href="<?php echo e(route('member.orders.index')); ?>">Riwayat Pesanan</a> / #<?php echo e($order->id); ?></p>
    </div>
</div>

<section class="section">
    <div class="container">
        <?php if($order->order_status !== 'Dibatalkan'): ?>
        <div class="panel">
            <div class="order-timeline">
                <?php $__currentLoopData = $statusOrder; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="timeline-step <?php echo e($i < $currentIndex ? 'done' : ($i == $currentIndex ? 'current' : '')); ?>">
                        <div class="timeline-dot"><?php echo e($i < $currentIndex ? '✓' : ($i+1)); ?></div>
                        <span class="label"><?php echo e($status); ?></span>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php else: ?>
        <div class="flash flash-error">⚠ Pesanan ini telah dibatalkan.</div>
        <?php endif; ?>

        <div class="detail-grid" style="align-items:start;">
            <div class="panel">
                <div class="panel-head">
                    <h3>Informasi Pesanan</h3>
                    <span class="badge badge-<?php echo e($order->status_badge); ?>"><?php echo e($order->order_status); ?></span>
                </div>
                <table class="data-table">
                    <tr><td style="font-weight:600; width:40%;">Paket</td><td><?php echo e($order->package->package_name); ?></td></tr>
                    <tr><td style="font-weight:600;">Kategori</td><td><?php echo e($order->package->category->category_name); ?></td></tr>
                    <tr><td style="font-weight:600;">Jumlah Porsi</td><td><?php echo e($order->quantity); ?> porsi</td></tr>
                    <tr><td style="font-weight:600;">Tanggal Pesan</td><td><?php echo e($order->order_date->format('d F Y')); ?></td></tr>
                    <tr><td style="font-weight:600;">Tanggal Kirim</td><td><?php echo e($order->delivery_date->format('d F Y')); ?></td></tr>
                    <tr><td style="font-weight:600;">Alamat Kirim</td><td><?php echo e($order->delivery_address); ?></td></tr>
                    <tr><td style="font-weight:600;">Metode Bayar</td><td>Transfer Bank</td></tr>
                    <tr><td style="font-weight:600;">Total Harga</td><td style="color: var(--clay); font-weight:700;"><?php echo e($order->formatted_total_price); ?></td></tr>
                    <?php if($order->notes): ?>
                    <tr><td style="font-weight:600;">Catatan</td><td><?php echo e($order->notes); ?></td></tr>
                    <?php endif; ?>
                </table>

                <?php if($order->canBeCancelled()): ?>
                    <form action="<?php echo e(route('member.orders.cancel', $order)); ?>" method="POST" data-confirm="Yakin ingin membatalkan pesanan ini?" style="margin-top: 20px;">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-danger">Batalkan Pesanan</button>
                    </form>
                <?php endif; ?>
            </div>

            <div class="panel">
                <h3>Pembayaran</h3>

                <?php if($order->order_status === 'Menunggu Pembayaran'): ?>
                    <p class="form-hint" style="margin-bottom:16px;">Silakan transfer ke rekening berikut, lalu unggah bukti pembayaran:</p>
                    <div class="panel" style="background: var(--cream-deep);">
                        <strong>Bank BCA</strong><br>
                        No. Rekening: 1234567890<br>
                        A/N: SantapKita Catering
                    </div>

                    <form action="<?php echo e(route('member.orders.upload-payment', $order)); ?>" method="POST" enctype="multipart/form-data" style="margin-top:20px;">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label for="proof_payment">Unggah Bukti Pembayaran</label>
                            <input type="file" id="proof_payment" name="proof_payment" class="form-control" accept="image/*" data-preview="previewImg">
                            <?php $__errorArgs = ['proof_payment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="form-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <img id="previewImg" style="display:none; margin-top:10px; border-radius:8px; max-height:200px;">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Unggah Bukti Pembayaran</button>
                    </form>
                <?php elseif($order->payment): ?>
                    <p><strong>Status Verifikasi:</strong> <span class="badge badge-<?php echo e($order->payment->status_badge); ?>"><?php echo e($order->payment->verification_status); ?></span></p>
                    <p><strong>Tanggal Bayar:</strong> <?php echo e($order->payment->payment_date->format('d F Y')); ?></p>
                    <?php if($order->payment->proof_payment): ?>
                        <img src="<?php echo e($order->payment->proof_payment_url); ?>" alt="Bukti Pembayaran" style="border-radius:8px; margin-top:10px; max-width:100%;">
                    <?php endif; ?>
                    <?php if($order->payment->notes): ?>
                        <p style="margin-top:12px;"><strong>Catatan Admin:</strong> <?php echo e($order->payment->notes); ?></p>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laravel10\santapkita\resources\views/member/orders/show.blade.php ENDPATH**/ ?>