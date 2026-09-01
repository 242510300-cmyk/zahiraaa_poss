

<?php $__env->startSection('title', 'Detail Transaksi'); ?>

<?php $__env->startSection('content'); ?>

<style>
body {
    background-color: #fff8ed;
}
.sales-container {
    background: #fff3dc;
    padding: 28px;
    border-radius: 20px;
    box-shadow: 0 8px 20px rgba(107, 66, 38, 0.08);
}
.page-title {
    color: #6b4226;
    font-weight: 800;
}
.card-custom {
    background: white;
    border-radius: 18px;
    padding: 20px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
}
.btn-back {
    background: #8b5e34;
    color: white;
    border-radius: 12px;
    padding: 8px 20px;
    font-weight: 600;
    border: none;
}
.btn-back:hover {
    background: #6f451f;
    color: white;
}
.btn-struk {
    background: #d9a441;
    color: white;
    border-radius: 12px;
    padding: 8px 20px;
    font-weight: 600;
    border: none;
}
.btn-struk:hover {
    background: #b8862c;
    color: white;
}
.badge-payment {
    background: #f3dfbd;
    color: #6b4226;
    border-radius: 20px;
    padding: 6px 14px;
    font-weight: 600;
    font-size: 0.85rem;
    display: inline-block;
}
.table-items thead th {
    color: #8b5e34;
    font-weight: 700;
    text-transform: uppercase;
    font-size: 0.8rem;
    border: none;
}
.table-items tbody td {
    border-color: #f3dfbd;
}
</style>

<div class="container my-4">
    <div class="sales-container">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="page-title mb-1">🧾 Detail Transaksi #TRX-<?php echo e($penjualan->id); ?></h3>
                <p class="text-muted mb-0">Rincian lengkap transaksi penjualan.</p>
            </div>
            <div>
                <a href="<?php echo e(route('penjualan.struk', $penjualan->id)); ?>" target="_blank" class="btn btn-struk shadow-sm me-2">
                    <i class="bi bi-receipt me-1"></i> Cetak Struk
                </a>
                <a href="<?php echo e(route('penjualan.index')); ?>" class="btn btn-back shadow-sm">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>

        <div class="card-custom mb-4">
            <div class="row">
                <div class="col-md-4 mb-2">
                    <small class="text-muted d-block">Tanggal</small>
                    <span class="fw-bold" style="color:#6b4226">
                        <?php echo e($penjualan->created_at ? $penjualan->created_at->format('d M Y, H:i') : '-'); ?>

                    </span>
                </div>
                <div class="col-md-4 mb-2">
                    <small class="text-muted d-block">Kasir</small>
                    <span class="fw-bold" style="color:#6b4226">
                        <?php echo e($penjualan->user->name ?? '-'); ?>

                    </span>
                </div>
                <div class="col-md-4 mb-2">
                    <small class="text-muted d-block">Status</small>
                    <?php if($penjualan->status === 'COMPLETED'): ?>
                        <span class="badge bg-success text-white px-2 py-1 rounded-pill">Selesai</span>
                    <?php else: ?>
                        <span class="badge bg-warning text-dark px-2 py-1 rounded-pill">Draft / Open</span>
                    <?php endif; ?>
                </div>
                <div class="col-md-4 mb-2">
                    <small class="text-muted d-block">Metode Pembayaran</small>
                    <span class="badge-payment">
                        <i class="bi bi-credit-card me-1"></i>
                        <?php echo e(strtoupper($penjualan->metode_pembayaran ?? 'Cash')); ?>

                    </span>
                </div>
                <div class="col-md-4 mb-2">
                    <small class="text-muted d-block">Total Pembayaran</small>
                    <span class="fw-bold text-success" style="font-size: 1.1rem;">
                        Rp <?php echo e(number_format($penjualan->total_pembayaran ?? 0, 0, ',', '.')); ?>

                    </span>
                </div>
            </div>
        </div>

        <div class="card-custom">
            <h5 class="mb-3" style="color:#6b4226">Daftar Item</h5>
            <div class="table-responsive">
                <table class="table table-items align-middle mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Produk</th>
                            <th>Harga Satuan</th>
                            <th>Kuantitas</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $penjualan->itemPenjualan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($item->produk->nama ?? '-'); ?></td>
                            <td>Rp <?php echo e(number_format($item->harga_satuan ?? $item->harga ?? 0, 0, ',', '.')); ?></td>
                            <td><?php echo e($item->kuantitas); ?></td>
                            <td>Rp <?php echo e(number_format($item->subtotal ?? 0, 0, ',', '.')); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted py-3">Tidak ada item.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\zahiraaa_poss\resources\views/penjualan/show.blade.php ENDPATH**/ ?>