<?php $__env->startSection('title', 'Riwayat Pesanan'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-banner">
    <div class="container">
        <h1>Riwayat Pesanan</h1>
        <p class="breadcrumb"><a href="<?php echo e(route('home')); ?>">Beranda</a> / Riwayat Pesanan</p>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="panel">
            <?php if($orders->count() > 0): ?>
                <div class="table-wrap">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Paket</th>
                                <th>Porsi</th>
                                <th>Tgl Kirim</th>
                                <th>Total</th>
                                <th>Pembayaran</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($order->package->package_name); ?></td>
                                    <td><?php echo e($order->quantity); ?></td>
                                    <td><?php echo e($order->delivery_date->format('d M Y')); ?></td>
                                    <td><?php echo e($order->formatted_total_price); ?></td>
                                    <td>Transfer Bank</td>
                                    <td><span class="badge badge-<?php echo e($order->status_badge); ?>"><?php echo e($order->order_status); ?></span></td>
                                    <td><a href="<?php echo e(route('member.orders.show', $order)); ?>" class="btn btn-outline btn-sm">Detail</a></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <div class="pagination-wrap"><?php echo e($orders->links()); ?></div>
            <?php else: ?>
                <div class="empty-state">
                    <div class="emoji">📭</div>
                    <h3>Belum ada pesanan</h3>
                    <p>Yuk mulai pesan paket catering favorit Anda.</p>
                    <a href="<?php echo e(route('packages.index')); ?>" class="btn btn-primary" style="margin-top:14px;">Lihat Paket</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laravel10\santapkita\resources\views/member/orders/index.blade.php ENDPATH**/ ?>