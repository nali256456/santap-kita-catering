<?php $__env->startSection('title', 'Edit Kategori'); ?>
<?php $__env->startSection('page-title', 'Edit Kategori'); ?>

<?php $__env->startSection('content'); ?>
<div class="panel" style="max-width: 560px;">
    <h3>Form Edit Kategori</h3>
    <form action="<?php echo e(route('admin.categories.update', $category)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="form-group">
            <label for="category_name">Nama Kategori</label>
            <input type="text" id="category_name" name="category_name" class="form-control" value="<?php echo e(old('category_name', $category->category_name)); ?>">
            <?php $__errorArgs = ['category_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="form-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="<?php echo e(route('admin.categories.index')); ?>" class="btn btn-outline">Batal</a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laravel10\santapkita\resources\views/admin/categories/edit.blade.php ENDPATH**/ ?>