<?php $__env->startSection('title', 'Kelola Pesanan'); ?>
<?php $__env->startSection('page-title', 'Kelola Pesanan'); ?>

<?php $__env->startSection('content'); ?>
<div class="panel">
    <div class="panel-head">
        <h3>Daftar Pesanan</h3>
    </div>

    <form action="<?php echo e(route('admin.orders.index')); ?>" method="GET" class="filter-bar">
        <input type="text" name="search" class="form-control" placeholder="Cari nama pelanggan..." value="<?php echo e(request('search')); ?>">
        <select name="status" class="form-control" onchange="this.form.submit()">
            <option value="">Semua Status</option>
            <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($status); ?>" <?php echo e(request('status') == $status ? 'selected' : ''); ?>><?php echo e($status); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

    <?php if($orders->count() > 0): ?>
        <div class="table-wrap">
            <table class="data-table">
                <thead>
                    <tr><th>Pelanggan</th><th>Paket</th><th>Porsi</th><th>Tgl Kirim</th><th>Total</th><th>Bayar</th><th>Status</th><th></th></tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($order->user->name); ?></td>
                            <td><?php echo e($order->package->package_name); ?></td>
                            <td><?php echo e($order->quantity); ?></td>
                            <td><?php echo e($order->delivery_date->format('d M Y')); ?></td>
                            <td><?php echo e($order->formatted_total_price); ?></td>
                            <td>Transfer</td>
                            <td><span class="badge badge-<?php echo e($order->status_badge); ?>"><?php echo e($order->order_status); ?></span></td>
                            <td><a href="<?php echo e(route('admin.orders.show', $order)); ?>" class="btn btn-outline btn-sm">Kelola</a></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <div class="pagination-wrap"><?php echo e($orders->links()); ?></div>
    <?php else: ?>
        <div class="empty-state"><div class="emoji">📭</div><p>Belum ada pesanan.</p></div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laravel10\santapkita\resources\views/admin/orders/index.blade.php ENDPATH**/ ?>