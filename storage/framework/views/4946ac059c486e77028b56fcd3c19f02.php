

<?php $__env->startSection('title', 'POS - Kasir'); ?>

<?php $__env->startSection('content'); ?>

<style>
    .pos-card {
        background-color: #fdf6ec;
        border: 1px solid #d8c3a5 !important;
    }

    .pos-card .table-light th {
        background-color: #f5ead9;
        color: #6b4226;
    }

    .pos-search input.form-control {
        border: 1px solid #d8c3a5;
    }

    .pos-search .input-group-text {
        border: 1px solid #d8c3a5;
        border-right: none;
    }

    .produk-row {
        border-bottom: 1px solid #e5dcc9 !important;
    }

    .produk-row:hover {
        background-color: #f9f1e4;
    }

    .btn-tambah-produk {
        background-color: #6b4226;
        border: none;
        color: #fff;
    }

    .btn-tambah-produk:hover {
        background-color: #55341d;
        color: #fff;
    }

    .btn-tambah-produk.disabled {
        background-color: #b7a48d;
    }

    .card-footer.pos-footer {
        background-color: #fdf6ec !important;
        border-top: 1px solid #d8c3a5 !important;
    }

    .total-bayar-label {
        color: #6b4226;
    }

    .total-bayar-value {
        color: #6b4226 !important;
    }

    .btn-checkout {
        background-color: #2e7d32;
        border: none;
        color: #fff;
    }

    .btn-checkout:hover {
        background-color: #256428;
        color: #fff;
    }

    .btn-checkout.disabled {
        background-color: #9bb99d;
    }

    .btn-batalkan {
        border: 1px solid #c0392b;
        color: #c0392b;
        background-color: #fff;
    }

    .btn-batalkan:hover {
        background-color: #fdecea;
        color: #c0392b;
    }

    select.form-select {
        border: 1px solid #d8c3a5;
    }
</style>


<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
        <?php echo e(session('success')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if(session('errors')): ?>
    <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
        <?php echo e(session('errors')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>      

<h4 class="mb-3 fw-bold" style="color: #6b4226;">Tambah dan Edit Transaksi</h4>

<div class="row">

    
    <div class="col-md-6">
        <div class="card pos-card shadow-sm border-0 rounded-3">
            <div class="card-body" style="max-height:72vh; overflow-y:auto">

                
                <div class="mb-3 pos-search">
                    <form method="GET" action="">
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                            <input
                                type="text"
                                name="search"
                                value="<?php echo e(request('search')); ?>"
                                class="form-control"
                                placeholder="Cari nama produk..."
                            >
                        </div>
                    </form>
                </div>

                
                <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <form method="POST" action="<?php echo e(route('penjualan.addItem', $sale->id)); ?>" class="row g-2 align-items-center mb-2 p-2 rounded produk-row">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="produk_id" value="<?php echo e($product->id); ?>">

                    
                    <div class="col-7">
                        <div class="d-flex align-items-center gap-2">
                            <img
                                src="<?php echo e($product->foto ? asset('storage/'.$product->foto) : 'https://via.placeholder.com/45'); ?>"
                                alt="<?php echo e($product->nama); ?>"
                                class="rounded-circle border"
                                style="width:45px; height:45px; object-fit:cover;"
                            >

                            <div>
                                <div class="fw-semibold text-dark text-truncate" style="max-width: 170px;">
                                    <?php echo e($product->nama); ?>

                                </div>
                                <small class="text-muted d-block">
                                    Rp <?php echo e(number_format($product->harga ?? $product->harga_jual ?? 0, 0, ',', '.')); ?>

                                </small>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-3">
                        <input
                            type="number"
                            name="quantity"
                            value="1"
                            min="1"
                            max="<?php echo e($product->stok); ?>"
                            class="form-control text-center"
                            <?php echo e(isset($sale) && $sale->status === 'COMPLETED' ? 'readonly' : ''); ?>

                        >
                    </div>

                    
                    <div class="col-2">
                        <button
                            type="submit"
                            class="btn btn-tambah-produk w-100 fw-bold
                            <?php echo e(isset($sale) && $sale->status === 'COMPLETED' ? 'disabled' : ''); ?>"
                        >
                            +
                        </button>
                    </div>

                </form>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="text-center text-muted py-4">
                        <i class="bi bi-box-seam fs-2 d-block mb-2"></i>
                        Produk tidak ditemukan.
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>


    
    <div class="col-md-6">
        <div class="card pos-card shadow-sm border-0 rounded-3">

            <div class="table-responsive" style="min-height: 250px;">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th width="80">Qty</th>
                            <th>Subtotal</th>
                            <th width="60" class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $sale->itemPenjualan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="fw-medium"><?php echo e($item->produk->nama ?? 'Produk Dihapus'); ?></td>
                            <td>Rp <?php echo e(number_format($item->harga ?? $item->produk->harga_jual ?? 0, 0, ',', '.')); ?></td>
                            
                            
                            <td>
                                <form method="POST" action="<?php echo e(route('itempenjualan.update', $item->id)); ?>">
                                    <?php echo csrf_field(); ?> 
                                    <?php echo method_field('PUT'); ?>
                                    <input
                                        type="number"
                                        name="kuantitas"
                                        value="<?php echo e($item->kuantitas); ?>"
                                        min="1"
                                        class="form-control form-control-sm text-center"
                                        onchange="this.form.submit()"
                                        <?php echo e($sale->status === 'COMPLETED' ? 'readonly' : ''); ?>

                                    >
                                </form>
                            </td>

                            <td class="fw-bold text-success">Rp <?php echo e(number_format($item->subtotal, 0, ',', '.')); ?></td>

                            
                            <td class="text-center">
                                <?php if($sale->status !== 'COMPLETED'): ?>
                                <form method="POST" action="<?php echo e(route('itempenjualan.destroy', $item->id)); ?>">
                                    <?php echo csrf_field(); ?> 
                                    <?php echo method_field('DELETE'); ?>
                                    <button class="btn btn-outline-danger btn-sm border-0" title="Hapus Item">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted py-5">
                                <i class="bi bi-cart-x fs-1 d-block mb-2 text-secondary"></i>
                                Keranjang masih kosong
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            
            <div class="card-footer pos-footer p-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="fs-5 fw-bold total-bayar-label">Total Bayar:</span>
                    <span class="fs-4 fw-bold total-bayar-value">
                        Rp <?php echo e(number_format($sale->itemPenjualan->sum('subtotal'), 0, ',', '.')); ?>

                    </span>
                </div>

                <form method="POST"
                      action="<?php echo e(route('penjualan.update', $sale->id)); ?>"
                      onsubmit="return confirm('Yakin ingin checkout transaksi ini?')" 
                      class="mt-2">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="mb-3">
                        <select name="payment_method" class="form-select" required <?php echo e($sale->status === 'COMPLETED' ? 'disabled' : ''); ?>>
                            <option value="">-- Pilih Metode Pembayaran --</option>
                            <option value="CASH">Cash (Tunai)</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-checkout w-100 fw-bold py-2 <?php echo e($sale->status === 'COMPLETED' ? 'disabled' : ''); ?>">
                        <i class="bi bi-check-circle me-1"></i> Checkout Sekarang
                    </button>
                </form>

                
                <?php if($sale->status !== 'COMPLETED'): ?>
                <form action="<?php echo e(route('penjualan.destroy', $sale->id)); ?>"
                      method="POST"
                      onsubmit="return confirm('Yakin ingin membatalkan transaksi ini? Stok akan dikembalikan.')">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>

                    <button type="submit" class="btn btn-batalkan w-100 mt-2">
                        <i class="bi bi-x-circle me-1"></i> Batalkan Transaksi
                    </button>
                </form>
                <?php endif; ?>

            </div>

        </div>
    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\zahiraaa_poss\resources\views/penjualan/pos.blade.php ENDPATH**/ ?>