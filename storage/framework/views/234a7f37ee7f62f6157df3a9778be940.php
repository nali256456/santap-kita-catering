<?php $__env->startSection('title', 'Edit Paket'); ?>
<?php $__env->startSection('page-title', 'Edit Paket Catering'); ?>

<?php $__env->startSection('content'); ?>
<div class="panel" style="max-width: 680px;">
    <h3>Form Edit Paket Catering</h3>
    <form action="<?php echo e(route('admin.packages.update', $package)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="form-group">
            <label for="category_id">Kategori</label>
            <select id="category_id" name="category_id" class="form-control">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($cat->id); ?>" <?php echo e(old('category_id', $package->category_id) == $cat->id ? 'selected' : ''); ?>><?php echo e($cat->category_name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="form-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="form-group">
            <label for="package_name">Nama Paket</label>
            <input type="text" id="package_name" name="package_name" class="form-control" value="<?php echo e(old('package_name', $package->package_name)); ?>">
            <?php $__errorArgs = ['package_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="form-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea id="description" name="description" class="form-control" rows="4"><?php echo e(old('description', $package->description)); ?></textarea>
            <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="form-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="form-group">
            <label for="price">Harga per Porsi (Rp)</label>
            <input type="number" id="price" name="price" class="form-control" value="<?php echo e(old('price', $package->price)); ?>">
            <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="form-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="form-group">
            <label for="image">Gambar Paket</label>
            <?php if($package->image): ?>
                <img src="<?php echo e($package->image_url); ?>" alt="<?php echo e($package->package_name); ?>" style="border-radius:8px; max-height:140px; margin-bottom:10px;">
            <?php endif; ?>
            <input type="file" id="image" name="image" class="form-control" accept="image/*" data-preview="previewImg">
            <span class="form-hint">Kosongkan jika tidak ingin mengubah gambar.</span>
            <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="form-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <img id="previewImg" style="display:none; margin-top:10px; border-radius:8px; max-height:200px;">
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="<?php echo e(route('admin.packages.index')); ?>" class="btn btn-outline">Batal</a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laravel10\santapkita\resources\views/admin/packages/edit.blade.php ENDPATH**/ ?>