<?php $__env->startSection('title', 'Tentang Kami'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-banner">
    <div class="container">
        <h1>Tentang SantapKita</h1>
        <p class="breadcrumb"><a href="<?php echo e(route('home')); ?>">Beranda</a> / Tentang Kami</p>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="detail-grid">
            <div>
                <span class="section-eyebrow">Cerita Kami</span>
                <h2>Dari dapur rumahan, untuk meja Anda</h2>
                <p class="detail-desc">SantapKita lahir dari kecintaan terhadap masakan rumahan Indonesia yang dimasak dengan bahan segar dan resep turun-temurun. Sejak berdiri, kami berkomitmen menghadirkan makanan berkualitas untuk kebutuhan harian, kantor, hingga acara spesial.</p>
                <p class="detail-desc">Setiap pesanan kami siapkan dengan standar kebersihan tinggi dan diantar tepat waktu, karena kami percaya pengalaman menyantap yang baik dimulai dari kepercayaan.</p>
            </div>
            <div class="detail-img" style="aspect-ratio: 1;">
                <img src="<?php echo e(asset('images/about-food.png')); ?>" alt="Hidangan catering SantapKita">
            </div>
        </div>
    </div>
</section>

<section class="section section-alt">
    <div class="container">
        <div class="section-head">
            <span class="section-eyebrow">Nilai Kami</span>
            <h2>Yang membuat kami berbeda</h2>
        </div>
        <div class="cat-grid">
            <div class="cat-card">
                <div class="cat-icon">🌿</div>
                <h4>Bahan Segar</h4>
                <span>Dipilih langsung dari pasar setiap hari</span>
            </div>
            <div class="cat-card">
                <div class="cat-icon">⏱️</div>
                <h4>Tepat Waktu</h4>
                <span>Pengiriman sesuai jadwal yang dipesan</span>
            </div>
            <div class="cat-card">
                <div class="cat-icon">💰</div>
                <h4>Harga Bersahabat</h4>
                <span>Kualitas terbaik dengan harga wajar</span>
            </div>
            <div class="cat-card">
                <div class="cat-icon">🤝</div>
                <h4>Pelayanan Ramah</h4>
                <span>Tim yang siap membantu kebutuhan Anda</span>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laravel10\santapkita\resources\views/guest/about.blade.php ENDPATH**/ ?>