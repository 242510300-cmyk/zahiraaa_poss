<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<style>

body {
    background-color: #fff8ed;
}

.dashboard-box {
    background: #fff3dc;
    padding: 25px;
    border-radius: 20px;
}

.dashboard-title {
    color: #6b4226;
    font-weight: 800;
}

.section-title {
    color: #6b4226;
    font-weight: 700;
    margin-bottom: 4px;
}

.card-custom {
    background: #ffffff;
    border-radius: 18px;
    padding: 20px;
    box-shadow: 0 8px 20px rgba(107,66,38,0.12);
    transition: .3s;
    border: 1px solid #f1dfc2;
}

.card-custom:hover {
    transform: translateY(-5px);
    box-shadow:0 12px 25px rgba(107,66,38,.2);
}

.btn-primary-custom {
    background:#8b5e34;
    color:white;
    border-radius:12px;
    padding:12px 20px;
    border:none;
}

.btn-primary-custom:hover {
    background:#6f451f;
    color:white;
}

.icon-box {
    width:65px;
    height:65px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    color:white;
    font-size:25px;
}

.list-item-custom {
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:10px 14px;
    border-radius:12px;
    background:#fff8ed;
    border:1px solid #f1dfc2;
    margin-bottom:8px;
}

.badge-stok-habis {
    background:#a05252;
    color:white;
    border-radius:8px;
    padding:4px 10px;
    font-size:12px;
    font-weight:600;
}

.badge-stok-rendah {
    background:#d9a441;
    color:white;
    border-radius:8px;
    padding:4px 10px;
    font-size:12px;
    font-weight:600;
}

.table-best-seller th {
    color:#6b4226;
    font-weight:700;
    border-bottom:2px solid #f1dfc2;
}

.table-best-seller td {
    vertical-align:middle;
    border-bottom:1px solid #f6ecd9;
}

</style>

<div class="container my-4">
<div class="dashboard-box">

    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="dashboard-title mb-1">
                ☕ Ringkasan Hari Ini
            </h3>
            <p class="text-muted mb-0">
                <?php echo e($tanggalHariIni->translatedFormat('l, d F Y')); ?>

            </p>
        </div>

        <a href="<?php echo e(route('penjualan.create')); ?>" class="btn btn-primary-custom shadow-sm">
            <i class="bi bi-plus-lg"></i>
            Transaksi Kasir
        </a>
    </div>

    <div class="row g-4 mb-4">

        
        <div class="col-md-6">
            <div class="card-custom h-100">
                <h5 class="section-title">Today's Sales</h5>
                <p class="text-muted small mb-3">Total penjualan dan transaksi hari ini</p>

                <div class="d-flex align-items-center mb-3">
                    <div class="icon-box me-3" style="background:linear-gradient(135deg,#8b5e34,#c08a52);">
                        <i class="bi bi-wallet2"></i>
                    </div>
                    <div>
                        <span class="text-muted small fw-semibold">Total Penjualan</span>
                        <h4 class="fw-bold mb-0" style="color:#6b4226">
                            Rp <?php echo e(number_format($ringkasan['total_penjualan'], 0, ',', '.')); ?>

                        </h4>
                    </div>
                </div>

                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background:linear-gradient(135deg,#d9a441,#f5c76b);">
                        <i class="bi bi-receipt"></i>
                    </div>
                    <div>
                        <span class="text-muted small fw-semibold">Jumlah Transaksi</span>
                        <h4 class="fw-bold mb-0" style="color:#6b4226">
                            <?php echo e($ringkasan['total_transaksi']); ?> Transaksi
                        </h4>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-md-6">
            <div class="card-custom h-100">
                <h5 class="section-title">Cash & Payment Status</h5>
                <p class="text-muted small mb-3">Rincian metode pembayaran hari ini</p>

                <div class="d-flex align-items-center mb-3">
                    <div class="icon-box me-3" style="background:linear-gradient(135deg,#3C6430,#7fae6c);">
                        <i class="bi bi-cash-stack"></i>
                    </div>
                    <div>
                        <span class="text-muted small fw-semibold">Total Pembayaran Tunai</span>
                        <h4 class="fw-bold mb-0" style="color:#6b4226">
                            Rp <?php echo e(number_format($ringkasan['total_cash'], 0, ',', '.')); ?>

                        </h4>
                    </div>
                </div>

                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background:linear-gradient(135deg,#4a6fa5,#7fa1d1);">
                        <i class="bi bi-credit-card"></i>
                    </div>
                    <div>
                        <span class="text-muted small fw-semibold">Total Pembayaran Non-Tunai</span>
                        <h4 class="fw-bold mb-0" style="color:#6b4226">
                            Rp <?php echo e(number_format($ringkasan['total_non_tunai'], 0, ',', '.')); ?>

                        </h4>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row g-4 mb-4">

        
        <div class="col-md-6">
            <div class="card-custom h-100">
                <h5 class="section-title">Critical Inventory Status</h5>
                <p class="text-muted small mb-3">Produk stok rendah & stok habis</p>

                <div class="mb-3">
                    <span class="fw-semibold small" style="color:#6b4226;">Stok Habis</span>
                    <?php $__empty_1 = true; $__currentLoopData = $produkStokHabis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="list-item-custom">
                            <span><?php echo e($produk->nama); ?></span>
                            <span class="badge-stok-habis">Habis</span>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-muted small mb-0">Tidak ada produk yang habis stok.</p>
                    <?php endif; ?>
                </div>

                <div>
                    <span class="fw-semibold small" style="color:#6b4226;">Stok Rendah</span>
                    <?php $__empty_1 = true; $__currentLoopData = $produkStokRendah; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="list-item-custom">
                            <span><?php echo e($produk->nama); ?></span>
                            <span class="badge-stok-rendah"><?php echo e($produk->stok); ?> tersisa</span>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-muted small mb-0">Tidak ada produk dengan stok rendah.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="col-md-6">
            <div class="card-custom h-100">
                <h5 class="section-title">Best Seller Product</h5>
                <p class="text-muted small mb-3">Produk terlaris hari ini</p>

                <div class="table-responsive">
                    <table class="table table-best-seller mb-0">
                        <thead>
                            <tr>
                                <th>Nama Produk</th>
                                <th>Stok</th>
                                <th>Terjual</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $produkTerlaris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($produk->nama); ?></td>
                                    <td><?php echo e($produk->stok); ?></td>
                                    <td><?php echo e($produk->total_terjual); ?> unit</td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="3" class="text-muted text-center">Belum ada produk terjual hari ini.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\POS_MILANNNN-main\POS_MILANNNN-main\resources\views/dashboard.blade.php ENDPATH**/ ?>