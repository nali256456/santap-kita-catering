<?php $__env->startSection('title', 'Kelola Paket'); ?>
<?php $__env->startSection('page-title', 'Kelola Paket Catering'); ?>

<?php $__env->startSection('content'); ?>
<div class="panel">
    <div class="panel-head">
        <h3>Daftar Paket Catering</h3>
        <a href="<?php echo e(route('admin.packages.create')); ?>" class="btn btn-primary">+ Tambah Paket</a>
    </div>

    <form action="<?php echo e(route('admin.packages.index')); ?>" method="GET" style="margin-bottom: 20px;">
        <input type="text" name="search" class="form-control" style="max-width: 320px;" placeholder="Cari paket..." value="<?php echo e(request('search')); ?>">
    </form>

    <?php if($packages->count() > 0): ?>
        <div class="table-wrap">
            <table class="data-table">
                <thead>
                    <tr><th>Gambar</th><th>Nama Paket</th><th>Kategori</th><th>Harga</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pkg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <div style="width:50px; height:50px; border-radius:8px; overflow:hidden; background: var(--cream-deep); display:flex; align-items:center; justify-content:center;">
                                    <?php if($pkg->image): ?>
                                        <img src="<?php echo e($pkg->image_url); ?>" alt="<?php echo e($pkg->package_name); ?>" style="width:100%; height:100%; object-fit:cover;">
                                    <?php else: ?>
                                        <span>🍱</span>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td><?php echo e($pkg->package_name); ?></td>
                            <td><span class="badge badge-secondary"><?php echo e($pkg->category->category_name); ?></span></td>
                            <td><?php echo e($pkg->formatted_price); ?></td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="<?php echo e(route('admin.packages.edit', $pkg)); ?>" class="btn btn-outline btn-sm">Edit</a>
                                    <form action="<?php echo e(route('admin.packages.destroy', $pkg)); ?>" method="POST" data-confirm="Hapus paket ini?">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <div class="pagination-wrap"><?php echo e($packages->links()); ?></div>
    <?php else: ?>
        <div class="empty-state"><div class="emoji">🍱</div><p>Belum ada paket catering.</p></div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laravel10\santapkita\resources\views/admin/packages/index.blade.php ENDPATH**/ ?>