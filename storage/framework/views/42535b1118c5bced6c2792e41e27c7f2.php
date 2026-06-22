<?php $__env->startSection('title', 'Masuk'); ?>

<?php $__env->startSection('content'); ?>
<div class="auth-wrap">
    <div class="auth-card">
        <div class="auth-head">
            <img src="<?php echo e(asset('images/logo.png')); ?>" alt="SantapKita" class="brand-mark" style="display:inline-flex;">
            <h2>Selamat Datang Kembali</h2>
            <p>Masuk untuk memesan catering favorit Anda</p>
        </div>

        <form action="<?php echo e(route('login.submit')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="<?php echo e(old('email')); ?>" placeholder="email@anda.com" autofocus>
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="form-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password">
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="form-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="form-group" style="display:flex; justify-content: space-between; align-items:center;">
                <label class="form-check">
                    <input type="checkbox" name="remember"> Ingat saya
                </label>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
            <a href="<?php echo e(route('google.login')); ?>" class="btn btn-outline btn-block" style="margin-top:10px;">  Masuk dengan Google </a>
        </form>

        <div class="auth-footer">
            Belum punya akun? <a href="<?php echo e(route('register')); ?>">Daftar di sini</a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laravel10\santapkita\resources\views/auth/login.blade.php ENDPATH**/ ?>