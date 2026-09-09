

<?php $__env->startSection('title', 'Tentang - MilanMart'); ?>

<?php $__env->startSection('content'); ?>


<div class="hero-section text-center mb-5">
    <div class="hero-badge mx-auto mb-3">
        <i class="bi bi-shop"></i>
    </div>
    <h1 class="hero-title">Tentang MilanMart</h1>
    <p class="hero-sub mb-4">Sistem Kasir Digital untuk Usaha Makanan Anda</p>
    <div class="d-flex flex-wrap justify-content-center gap-2">
        <span class="pill"><i class="bi bi-check-circle"></i> Cepat & Mudah</span>
        <span class="pill"><i class="bi bi-shield-check"></i> Akses Berbasis Role</span>
        <span class="pill"><i class="bi bi-receipt"></i> Struk Otomatis</span>
    </div>
</div>


<div class="row mb-5">
    <div class="col-lg-9 mx-auto">
        <div class="desc-card">
            <p class="mb-3">
                <strong>MilanMart POSS</strong> adalah aplikasi kasir digital (Point of Sale)
                yang dirancang khusus untuk membantu pemilik usaha makanan mengelola operasional
                toko sehari-hari secara lebih mudah, cepat, dan akurat.
            </p>
            <p class="mb-0">
                Mulai dari pencatatan menu dan kategori makanan, pengelolaan stok, proses transaksi
                di kasir, hingga pencetakan struk — semuanya terintegrasi dalam satu sistem. Dengan
                pembagian akses berdasarkan peran pengguna (Admin dan Kasir), MilanMart POSS juga
                membantu menjaga keamanan data serta kelancaran operasional bisnis Anda.
            </p>
        </div>
    </div>
</div>


<div class="section-title text-center mb-5">
    <span class="eyebrow">Alur Sederhana</span>
    <h2>Cara Kerjanya</h2>
    <p>Tiga langkah mudah dari kelola menu sampai transaksi selesai</p>
</div>

<div class="row mb-5 workflow-row">
    <div class="col-md-4 text-center mb-4 mb-md-0">
        <div class="wf-circle mx-auto mb-3">1</div>
        <h5>Kelola Menu & Stok</h5>
        <p class="text-muted small px-2">Tambahkan produk, atur jenis makanan, dan pantau stok yang tersedia.</p>
    </div>
    <div class="col-md-4 text-center mb-4 mb-md-0">
        <div class="wf-circle mx-auto mb-3">2</div>
        <h5>Proses di Kasir</h5>
        <p class="text-muted small px-2">Kasir menambahkan pesanan pelanggan ke keranjang dan memproses pembayaran.</p>
    </div>
    <div class="col-md-4 text-center">
        <div class="wf-circle mx-auto mb-3">3</div>
        <h5>Struk & Laporan</h5>
        <p class="text-muted small px-2">Struk tercetak otomatis, transaksi tercatat rapi untuk dipantau kapan saja.</p>
    </div>
</div>


<div class="section-title text-center mb-4">
    <span class="eyebrow">Semua Dalam Satu Aplikasi</span>
    <h2>Fitur Unggulan</h2>
    <p>Semua yang Anda butuhkan untuk mengelola toko dalam satu aplikasi</p>
</div>

<div class="row g-4 mb-5">

    <div class="col-md-6 col-lg-4">
        <div class="feature-card h-100">
            <div class="feature-icon"><i class="bi bi-egg-fried"></i></div>
            <h5>Manajemen Jenis Makanan</h5>
            <p>Kelompokkan menu ke dalam kategori jenis makanan agar lebih mudah dicari dan dikelola.</p>
        </div>
    </div>

    <div class="col-md-6 col-lg-4">
        <div class="feature-card h-100">
            <div class="feature-icon"><i class="bi bi-box-seam"></i></div>
            <h5>Manajemen Produk</h5>
            <p>Tambah, ubah, dan pantau daftar produk beserta harga dan ketersediaan stok secara real-time.</p>
        </div>
    </div>

    <div class="col-md-6 col-lg-4">
        <div class="feature-card h-100">
            <div class="feature-icon"><i class="bi bi-cart3"></i></div>
            <h5>Transaksi Kasir Cepat</h5>
            <p>Tambahkan item ke keranjang, proses pembayaran, dan selesaikan transaksi dalam beberapa langkah.</p>
        </div>
    </div>

    <div class="col-md-6 col-lg-4">
        <div class="feature-card h-100">
            <div class="feature-icon"><i class="bi bi-receipt"></i></div>
            <h5>Cetak Struk Otomatis</h5>
            <p>Setiap transaksi dapat langsung dicetak dalam bentuk struk rapi sebagai bukti pembayaran.</p>
        </div>
    </div>

    <div class="col-md-6 col-lg-4">
        <div class="feature-card h-100">
            <div class="feature-icon"><i class="bi bi-people"></i></div>
            <h5>Manajemen Pengguna & Role</h5>
            <p>Akses dibagi berdasarkan peran — Admin dan Kasir — agar setiap orang mengakses fitur sesuai tanggung jawabnya.</p>
        </div>
    </div>

    <div class="col-md-6 col-lg-4">
        <div class="feature-card h-100">
            <div class="feature-icon"><i class="bi bi-graph-up"></i></div>
            <h5>Dashboard & Ringkasan</h5>
            <p>Pantau ringkasan aktivitas toko melalui dashboard yang informatif setelah login.</p>
        </div>
    </div>

</div>


<div class="cta-box text-center mb-4">
    <h3>Siap kelola toko Anda lebih mudah?</h3>
    <p>Masuk ke dashboard dan mulai kelola menu, stok, dan transaksi hari ini juga.</p>
    <?php if(auth()->guard()->check()): ?>
        <a href="<?php echo e(route('dashboard')); ?>" class="cta-btn">
            <i class="bi bi-box-arrow-in-right"></i> Masuk ke Dashboard
        </a>
    <?php else: ?>
        <a href="<?php echo e(route('login')); ?>" class="cta-btn">
            <i class="bi bi-box-arrow-in-right"></i> Masuk Sekarang
        </a>
    <?php endif; ?>
</div>

<p class="text-center footnote">MilanMart POSS — Dibuat untuk mempermudah pengelolaan usaha makanan Anda.</p>

<style>
    .hero-section {
        background: linear-gradient(160deg, #FDF9F0 0%, #FAF3E0 100%);
        border: 1px solid #F0E4C8;
        border-radius: 32px;
        padding: 60px 24px 50px;
        position: relative;
        overflow: hidden;
    }
    .hero-badge {
        width: 84px; height: 84px; border-radius: 50%;
        background: linear-gradient(135deg, #FAF3E0, #F3E5C4);
        border: 2px solid #E6D7BC;
        box-shadow: 0 8px 20px rgba(180, 150, 90, 0.18);
        display: flex; align-items: center; justify-content: center;
    }
    .hero-badge i { font-size: 2.1rem; color: #8A5A2B; }
    .hero-title { font-size: 2.5rem; font-weight: 800; color: #3A2E28; letter-spacing: -0.5px; }
    .hero-sub { color: #9A8A79; font-size: 1.08rem; }

    .pill {
        display: inline-flex; align-items: center; gap: 6px;
        background: #ffffff; border: 1px solid #EFE0BC; border-radius: 999px;
        padding: 8px 16px; font-size: 0.82rem; font-weight: 600; color: #8A5A2B;
    }

    .desc-card {
        background: #ffffff; border: 1px solid #F0E4C8; border-radius: 22px;
        padding: 36px 40px; box-shadow: 0 10px 30px rgba(120, 90, 40, 0.06);
        position: relative; overflow: hidden;
    }
    .desc-card::before {
        content: ""; position: absolute; top: 0; left: 0; width: 6px; height: 100%;
        background: linear-gradient(180deg, #D9A441, #C97B4A);
    }
    .desc-card p { line-height: 1.9; font-size: 1.02rem; color: #5C4D42; }
    .desc-card strong { color: #3A2E28; }

    .section-title .eyebrow {
        display: inline-block; font-size: 0.78rem; font-weight: 700; letter-spacing: 1.5px;
        text-transform: uppercase; color: #C97B4A; margin-bottom: 8px;
    }
    .section-title h2 { font-size: 1.8rem; font-weight: 800; color: #3A2E28; margin-bottom: 6px; }
    .section-title p { color: #9A8A79; margin-bottom: 0; }

    .wf-circle {
        width: 64px; height: 64px; border-radius: 50%;
        background: #ffffff; border: 2px solid #E6D7BC;
        display: flex; align-items: center; justify-content: center;
        font-weight: 800; font-size: 1.25rem; color: #C97B4A;
        box-shadow: 0 6px 16px rgba(120,90,40,0.08);
    }
    .workflow-row h5 { font-weight: 700; color: #3A2E28; }

    .feature-card {
        background: #ffffff; border: 1px solid #F0E4C8; border-radius: 20px;
        padding: 30px 26px;
        transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
    }
    .feature-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 18px 36px rgba(120, 90, 40, 0.14);
        border-color: #E6D7BC;
    }
    .feature-icon {
        width: 54px; height: 54px; border-radius: 15px;
        background: linear-gradient(135deg, #FAF3E0, #F3E5C4);
        display: flex; align-items: center; justify-content: center;
        margin-bottom: 16px;
    }
    .feature-icon i { font-size: 1.4rem; color: #8A5A2B; }
    .feature-card h5 { font-weight: 700; color: #3A2E28; font-size: 1.05rem; margin-bottom: 8px; }
    .feature-card p { color: #9A8A79; font-size: 0.9rem; line-height: 1.7; margin-bottom: 0; }

    .cta-box {
        background: linear-gradient(135deg, #3A2E28, #5C4636);
        color: #FAF3E0; border-radius: 26px; padding: 46px 30px;
    }
    .cta-box h3 { color: #ffffff; font-weight: 800; font-size: 1.4rem; margin-bottom: 8px; }
    .cta-box p { color: #D9C7A0; margin-bottom: 22px; }
    .cta-btn {
        display: inline-flex; align-items: center; gap: 8px;
        background: #D9A441; color: #3A2E28 !important; font-weight: 700;
        padding: 12px 28px; border-radius: 999px; text-decoration: none; font-size: 0.95rem;
        transition: transform .2s ease, box-shadow .2s ease;
    }
    .cta-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(217,164,65,0.35);
        color: #3A2E28 !important;
    }

    .footnote { color: #B5A895; font-size: 0.86rem; }

    @media (max-width: 576px) {
        .hero-title { font-size: 2rem; }
        .hero-section { padding: 44px 20px 40px; }
        .desc-card { padding: 26px 22px; }
    }
</style>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\zahiraaa_poss\resources\views/tentang.blade.php ENDPATH**/ ?>