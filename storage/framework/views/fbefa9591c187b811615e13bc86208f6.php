<?php $__env->startSection('title', 'Kelola Kategori'); ?>
<?php $__env->startSection('page-title', 'Kelola Kategori'); ?>

<?php $__env->startSection('content'); ?>
<div class="panel">
    <div class="panel-head">
        <h3>Daftar Kategori</h3>
        <a href="<?php echo e(route('admin.categories.create')); ?>" class="btn btn-primary">+ Tambah Kategori</a>
    </div>

    <?php if($categories->count() > 0): ?>
        <div class="table-wrap">
            <table class="data-table">
                <thead>
                    <tr><th>Nama Kategori</th><th>Jumlah Paket</th><th>Dibuat</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($cat->category_name); ?></td>
                            <td><span class="badge badge-secondary"><?php echo e($cat->packages_count); ?> paket</span></td>
                            <td><?php echo e($cat->created_at->format('d M Y')); ?></td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="<?php echo e(route('admin.categories.edit', $cat)); ?>" class="btn btn-outline btn-sm">Edit</a>
                                    <form action="<?php echo e(route('admin.categories.destroy', $cat)); ?>" method="POST" data-confirm="Hapus kategori ini?">
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
        <div class="pagination-wrap"><?php echo e($categories->links()); ?></div>
    <?php else: ?>
        <div class="empty-state"><div class="emoji">🏷️</div><p>Belum ada kategori.</p></div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laravel10\santapkita\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>