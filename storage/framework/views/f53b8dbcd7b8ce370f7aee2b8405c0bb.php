<?php $__env->startSection('title', 'Detail Pesanan'); ?>
<?php $__env->startSection('page-title', 'Detail Pesanan #' . $order->id); ?>

<?php $__env->startSection('content'); ?>
<div class="detail-grid" style="align-items:start;">
    <div class="panel">
        <div class="panel-head">
            <h3>Informasi Pesanan</h3>
            <span class="badge badge-<?php echo e($order->status_badge); ?>"><?php echo e($order->order_status); ?></span>
        </div>
        <table class="data-table">
            <tr><td style="font-weight:600; width:40%;">Pelanggan</td><td><?php echo e($order->user->name); ?> (<?php echo e($order->user->email); ?>)</td></tr>
            <tr><td style="font-weight:600;">No. Telepon</td><td><?php echo e($order->user->phone ?? '-'); ?></td></tr>
            <tr><td style="font-weight:600;">Paket</td><td><?php echo e($order->package->package_name); ?></td></tr>
            <tr><td style="font-weight:600;">Kategori</td><td><?php echo e($order->package->category->category_name); ?></td></tr>
            <tr><td style="font-weight:600;">Jumlah Porsi</td><td><?php echo e($order->quantity); ?> porsi</td></tr>
            <tr><td style="font-weight:600;">Tanggal Pesan</td><td><?php echo e($order->order_date->format('d F Y')); ?></td></tr>
            <tr><td style="font-weight:600;">Tanggal Kirim</td><td><?php echo e($order->delivery_date->format('d F Y')); ?></td></tr>
            <tr><td style="font-weight:600;">Alamat Kirim</td><td><?php echo e($order->delivery_address); ?></td></tr>
            <tr><td style="font-weight:600;">Metode Bayar</td><td>Transfer Bank</td></tr>
            <tr><td style="font-weight:600;">Total Harga</td><td style="color: var(--clay); font-weight:700;"><?php echo e($order->formatted_total_price); ?></td></tr>
            <?php if($order->notes): ?>
            <tr><td style="font-weight:600;">Catatan Pelanggan</td><td><?php echo e($order->notes); ?></td></tr>
            <?php endif; ?>
        </table>
    </div>

    <div class="panel">
        <h3>Ubah Status Pesanan</h3>
        <form action="<?php echo e(route('admin.orders.update-status', $order)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="form-group">
                <label for="order_status">Status Pesanan</label>
                <select id="order_status" name="order_status" class="form-control">
                    <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($status); ?>" <?php echo e($order->order_status == $status ? 'selected' : ''); ?>><?php echo e($status); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Perbarui Status</button>
        </form>

        <?php if($order->payment): ?>
            <div class="dash-nav-divider" style="border-color: var(--line); margin: 24px 0;"></div>
            <h3>Pembayaran</h3>
            <p><strong>Status Verifikasi:</strong> <span class="badge badge-<?php echo e($order->payment->status_badge); ?>"><?php echo e($order->payment->verification_status); ?></span></p>
            <p><strong>Tanggal Bayar:</strong> <?php echo e($order->payment->payment_date->format('d F Y')); ?></p>
            <?php if($order->payment->proof_payment): ?>
                <img src="<?php echo e($order->payment->proof_payment_url); ?>" alt="Bukti Pembayaran" style="border-radius:8px; margin-top:10px; max-width:100%;">
            <?php endif; ?>
            <a href="<?php echo e(route('admin.payments.show', $order->payment)); ?>" class="btn btn-outline btn-block" style="margin-top:14px;">Verifikasi Pembayaran</a>
        <?php else: ?>
            <div class="dash-nav-divider" style="border-color: var(--line); margin: 24px 0;"></div>
            <p class="form-hint">Pelanggan belum mengunggah bukti pembayaran.</p>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laravel10\santapkita\resources\views/admin/orders/show.blade.php ENDPATH**/ ?>