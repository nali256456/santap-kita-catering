<?php $__env->startSection('title', 'Dashboard Admin'); ?>
<?php $__env->startSection('page-title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="stat-grid">
    <div class="stat-card">
        <div class="stat-icon">📋</div>
        <div class="stat-val"><?php echo e($stats['total_orders']); ?></div>
        <div class="stat-label">Total Pesanan</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon">🍱</div>
        <div class="stat-val"><?php echo e($stats['total_packages']); ?></div>
        <div class="stat-label">Total Paket</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon">👥</div>
        <div class="stat-val"><?php echo e($stats['total_users']); ?></div>
        <div class="stat-label">Total Pelanggan</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon">💳</div>
        <div class="stat-val"><?php echo e($stats['pending_payments']); ?></div>
        <div class="stat-label">Menunggu Verifikasi</div>
    </div>
</div>

<div class="stat-grid" style="grid-template-columns: 1fr 1fr;">
    <div class="stat-card">
        <div class="stat-icon">💰</div>
        <div class="stat-val">Rp <?php echo e(number_format($stats['total_revenue'], 0, ',', '.')); ?></div>
        <div class="stat-label">Total Pendapatan (Pesanan Selesai)</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon">📅</div>
        <div class="stat-val"><?php echo e($stats['orders_today']); ?></div>
        <div class="stat-label">Pesanan Hari Ini</div>
    </div>
</div>

<div class="detail-grid" style="align-items:start; grid-template-columns: 1.6fr 1fr;">
    <div class="panel">
        <div class="panel-head">
            <h3>Pesanan Terbaru</h3>
            <a href="<?php echo e(route('admin.orders.index')); ?>" class="btn btn-outline btn-sm">Lihat Semua</a>
        </div>
        <?php if($recentOrders->count() > 0): ?>
            <div class="table-wrap">
                <table class="data-table">
                    <thead>
                        <tr><th>Pelanggan</th><th>Paket</th><th>Total</th><th>Status</th><th></th></tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $recentOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($order->user->name); ?></td>
                                <td><?php echo e($order->package->package_name); ?></td>
                                <td><?php echo e($order->formatted_total_price); ?></td>
                                <td><span class="badge badge-<?php echo e($order->status_badge); ?>"><?php echo e($order->order_status); ?></span></td>
                                <td><a href="<?php echo e(route('admin.orders.show', $order)); ?>" class="btn btn-outline btn-sm">Detail</a></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="empty-state"><div class="emoji">📭</div><p>Belum ada pesanan masuk.</p></div>
        <?php endif; ?>
    </div>

    <div class="panel">
        <h3>Paket Terpopuler</h3>
        <?php if($popularPackages->count() > 0): ?>
            <?php $__currentLoopData = $popularPackages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pkg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div style="display:flex; justify-content:space-between; align-items:center; padding: 12px 0; border-bottom: 1px solid var(--line);">
                    <div>
                        <div style="font-weight:600; font-size:0.9rem;"><?php echo e($pkg->package_name); ?></div>
                        <div style="font-size:0.78rem; color:var(--ink-soft);"><?php echo e($pkg->orders_count); ?> pesanan</div>
                    </div>
                    <span class="badge badge-primary"><?php echo e($pkg->orders_count); ?></span>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <p class="form-hint">Belum ada data.</p>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laravel10\santapkita\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>