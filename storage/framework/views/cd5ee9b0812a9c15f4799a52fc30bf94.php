

<?php $__env->startSection('title', 'Penjualan'); ?>

<?php $__env->startSection('content'); ?>

<style>
body {
    background-color: #fff8ed;
}

/* Container Utama */
.sales-container {
    background: #fff3dc;
    padding: 28px;
    border-radius: 20px;
    box-shadow: 0 8px 20px rgba(107, 66, 38, 0.08);
}

/* Judul */
.page-title {
    color: #6b4226;
    font-weight: 800;
}

/* Card Wrapper */
.card-custom {
    background: white;
    border-radius: 18px;
    padding: 20px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
}

/* Button Utama (Transaksi Baru) */
.btn-primary-custom {
    background: #8b5e34;
    color: white;
    border-radius: 12px;
    padding: 10px 22px;
    font-weight: 600;
    border: none;
    transition: all 0.2s ease-in-out;
}

.btn-primary-custom:hover {
    background: #6f451f;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(111, 69, 31, 0.3);
}

/* Table Design Modern */
.table-custom {
    border-collapse: separate;
    border-spacing: 0 8px;
}

.table-custom thead tr {
    background: transparent;
}

.table-custom thead th {
    color: #8b5e34;
    font-weight: 700;
    text-transform: uppercase;
    font-size: 0.8rem;
    letter-spacing: 0.05em;
    border: none;
    padding: 12px 16px;
}

.table-custom tbody tr {
    background: #ffffff;
    box-shadow: 0 2px 6px rgba(107, 66, 38, 0.05);
    transition: all 0.2s ease;
}

.table-custom tbody tr:hover {
    background: #fff8ed;
    transform: scale(1.002);
}

.table-custom tbody td {
    padding: 14px 16px;
    border: none;
}

.table-custom tbody tr td:first-child { 
    border-top-left-radius: 12px; 
    border-bottom-left-radius: 12px; 
}

.table-custom tbody tr td:last-child { 
    border-top-right-radius: 12px; 
    border-bottom-right-radius: 12px; 
}

/* Badge Metode Pembayaran & Status */
.badge-payment {
    background: #f3dfbd;
    color: #6b4226;
    border-radius: 20px;
    padding: 6px 14px;
    font-weight: 600;
    font-size: 0.85rem;
    display: inline-block;
}

/* Detail Button */
.btn-detail {
    background: #d9a441;
    color: white;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.2s;
}

.btn-detail:hover {
    background: #b8862c;
    color: white;
}
</style>

<div class="container my-4">
    <div class="sales-container">
        
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="page-title mb-1">🛒 Riwayat Penjualan</h3>
                <p class="text-muted mb-0">Catatan seluruh transaksi yang pernah dilakukan.</p>
            </div>

            <a href="<?php echo e(route('penjualan.create')); ?>" class="btn btn-primary-custom shadow-sm">
                <i class="bi bi-plus-lg me-1"></i> Transaksi Baru
            </a>
        </div>

        
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        
        <?php if(session('errors')): ?>
            <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-4" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> <?php echo e(session('errors')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        
        <div class="card-custom">
            <div class="table-responsive">
                <table class="table table-custom align-middle mb-0">
                    <thead>
                        <tr>
                            <th width="60">#</th>
                            <th>ID Transaksi</th>
                            <th>Tanggal</th>
                            <th>Kasir</th>
                            <th>Total Bayar</th>
                            <th>Metode</th>
                            <th>Status</th>
                            <th class="text-center" width="120">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $penjualans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="fw-bold text-muted ps-3">
                                <?php echo e(($penjualans->currentPage() - 1) * $penjualans->perPage() + $loop->iteration); ?>

                            </td>

                            <td>
                                <span class="fw-bold" style="color:#6b4226">
                                    #TRX-<?php echo e($item->id); ?>

                                </span>
                            </td>

                            <td class="text-secondary fw-medium">
                                <i class="bi bi-calendar3 me-1 text-warning"></i>
                                <?php echo e($item->created_at ? $item->created_at->format('d M Y, H:i') : '-'); ?>

                            </td>

                            <td class="text-secondary fw-medium">
                                <i class="bi bi-person-fill me-1 text-warning"></i>
                                <?php echo e($item->user->name ?? '-'); ?>

                            </td>

                            <td>
                                <span class="fw-bold text-success" style="font-size: 1.05rem;">
                                    Rp <?php echo e(number_format($item->total_pembayaran ?? 0, 0, ',', '.')); ?>

                                </span>
                            </td>

                            <td>
                                <span class="badge-payment">
                                    <i class="bi bi-credit-card me-1"></i>
                                    <?php echo e(strtoupper($item->metode_pembayaran ?? 'Cash')); ?>

                                </span>
                            </td>

                            <td>
                                <?php if($item->status === 'COMPLETED'): ?>
                                    <span class="badge bg-success text-white px-2 py-1 rounded-pill">Selesai</span>
                                <?php else: ?>
                                    <span class="badge bg-warning text-dark px-2 py-1 rounded-pill">Draft / Open</span>
                                <?php endif; ?>
                            </td>

                            <td class="text-center pe-3">
                                <?php if($item->status === 'OPEN'): ?>
                                    <a href="<?php echo e(route('penjualan.edit', $item->id)); ?>" class="btn btn-sm btn-warning text-white px-3 py-1 me-1">
                                        <i class="bi bi-pencil-square me-1"></i> Lanjut
                                    </a>
                                <?php else: ?>
                                    <a href="<?php echo e(route('penjualan.show', $item->id)); ?>" class="btn btn-sm btn-detail px-3 py-1">
                                        <i class="bi bi-eye me-1"></i> Detail
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="bi bi-receipt fs-1 d-block mb-2" style="color: #d9a441;"></i>
                                Belum ada data transaksi penjualan.
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            
            <?php if($penjualans->hasPages()): ?>
                <div class="mt-4 d-flex justify-content-end">
                    <?php echo e($penjualans->links()); ?>

                </div>
            <?php endif; ?>
        </div>

    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\MIMIL_POS\resources\views/penjualan/index.blade.php ENDPATH**/ ?>