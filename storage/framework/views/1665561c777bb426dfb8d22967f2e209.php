<?php $__env->startSection('title', 'Verifikasi Pembayaran'); ?>
<?php $__env->startSection('page-title', 'Verifikasi Pembayaran'); ?>

<?php $__env->startSection('content'); ?>
<div class="detail-grid" style="align-items:start;">
    <div class="panel">
        <h3>Bukti Pembayaran</h3>
        <?php if($payment->proof_payment): ?>
            <img src="<?php echo e($payment->proof_payment_url); ?>" alt="Bukti Pembayaran" style="border-radius:12px; width:100%; margin-top:10px;">
        <?php else: ?>
            <div class="empty-state"><div class="emoji">🧾</div><p>Belum ada bukti pembayaran yang diunggah.</p></div>
        <?php endif; ?>
    </div>

    <div>
        <div class="panel">
            <h3>Informasi Pesanan</h3>
            <table class="data-table">
                <tr><td style="font-weight:600; width:45%;">Pelanggan</td><td><?php echo e($payment->order->user->name); ?></td></tr>
                <tr><td style="font-weight:600;">Paket</td><td><?php echo e($payment->order->package->package_name); ?></td></tr>
                <tr><td style="font-weight:600;">Jumlah Porsi</td><td><?php echo e($payment->order->quantity); ?></td></tr>
                <tr><td style="font-weight:600;">Total Harga</td><td style="color:var(--clay); font-weight:700;"><?php echo e($payment->order->formatted_total_price); ?></td></tr>
                <tr><td style="font-weight:600;">Tanggal Bayar</td><td><?php echo e($payment->payment_date->format('d F Y')); ?></td></tr>
                <tr><td style="font-weight:600;">Status Saat Ini</td><td><span class="badge badge-<?php echo e($payment->status_badge); ?>"><?php echo e($payment->verification_status); ?></span></td></tr>
            </table>
        </div>

        <div class="panel">
            <h3>Verifikasi Pembayaran</h3>
            <form action="<?php echo e(route('admin.payments.verify', $payment)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="form-group">
                    <label for="verification_status">Status Verifikasi</label>
                    <select id="verification_status" name="verification_status" class="form-control">
                        <option value="Disetujui" <?php echo e($payment->verification_status == 'Disetujui' ? 'selected' : ''); ?>>Disetujui</option>
                        <option value="Ditolak" <?php echo e($payment->verification_status == 'Ditolak' ? 'selected' : ''); ?>>Ditolak</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="notes">Catatan (opsional)</label>
                    <textarea id="notes" name="notes" class="form-control" rows="3" placeholder="Contoh: Nominal transfer tidak sesuai"><?php echo e($payment->notes); ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Simpan Verifikasi</button>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laravel10\santapkita\resources\views/admin/payments/show.blade.php ENDPATH**/ ?>