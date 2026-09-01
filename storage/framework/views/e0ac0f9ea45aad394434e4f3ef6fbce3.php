<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk #TRX-<?php echo e($penjualan->id); ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #fff8ed;
            padding: 40px 20px;
        }
        .struk-wrapper {
            max-width: 650px;
            margin: 0 auto;
            background: #fff3dc;
            border-radius: 24px;
            padding: 32px;
            box-shadow: 0 10px 28px rgba(107, 66, 38, 0.15);
        }
        .receipt-card {
            background: #ffffff;
            border-radius: 18px;
            padding: 36px;
        }
        .text-center { text-align: center; }
        .store-icon {
            font-size: 2.8rem;
            margin-bottom: 6px;
        }
        .store-name {
            font-size: 2rem;
            font-weight: 800;
            color: #6b4226;
            letter-spacing: 1px;
        }
        .store-tagline {
            font-size: 1rem;
            color: #a97f56;
            margin-bottom: 20px;
        }
        .divider {
            border: none;
            border-top: 2px dashed #f0d9ad;
            margin: 20px 0;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px 24px;
        }
        .info-item small {
            display: block;
            color: #a97f56;
            font-size: 0.85rem;
            margin-bottom: 3px;
        }
        .info-item strong {
            color: #6b4226;
            font-size: 1.05rem;
        }
        .badge-status {
            background: #d9a441;
            color: white;
            border-radius: 20px;
            padding: 5px 16px;
            font-weight: 600;
            font-size: 0.9rem;
            display: inline-block;
        }
        table {
            width: 100%;
            font-size: 1rem;
            margin: 10px 0;
            border-collapse: collapse;
        }
        table th {
            text-align: left;
            color: #8b5e34;
            font-weight: 700;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            border-bottom: 2px solid #f3dfbd;
            padding-bottom: 10px;
        }
        table td {
            padding: 16px 0;
            vertical-align: top;
            border-bottom: 1px dashed #f3dfbd;
            color: #4a3320;
        }
        .text-right { text-align: right; }
        .item-name {
            display: block;
            font-weight: 600;
            color: #6b4226;
            font-size: 1.05rem;
        }
        .item-sub {
            font-size: 0.88rem;
            color: #a97f56;
            margin-top: 2px;
        }
        .item-subtotal {
            font-weight: 700;
            color: #6b4226;
            font-size: 1.05rem;
        }
        .total-box {
            background: #fff3dc;
            border-radius: 14px;
            padding: 20px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 18px;
        }
        .total-label {
            font-weight: 700;
            color: #6b4226;
            font-size: 1.15rem;
        }
        .total-amount {
            font-weight: 800;
            color: #2e7d32;
            font-size: 1.8rem;
        }
        .footer-note {
            text-align: center;
            font-size: 0.9rem;
            margin-top: 22px;
            color: #a97f56;
            font-style: italic;
        }
        .btn-group {
            max-width: 650px;
            margin: 20px auto 0;
            display: flex;
            gap: 12px;
        }
        .btn-group a, .btn-group button {
            flex: 1;
            text-align: center;
            padding: 14px;
            border-radius: 14px;
            font-weight: 600;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            transition: all 0.2s ease-in-out;
        }
        .btn-print {
            background: #8b5e34;
            color: #fff;
        }
        .btn-print:hover {
            background: #6f451f;
        }
        .btn-back {
            background: #f3dfbd;
            color: #6b4226;
        }
        .btn-back:hover {
            background: #ebd09a;
        }

        @media print {
            body { background: #fff; padding: 0; }
            .struk-wrapper {
                box-shadow: none;
                max-width: 100%;
                background: #fff;
                border-radius: 0;
            }
            .receipt-card { padding: 0; }
            .btn-group { display: none; }
        }
    </style>
</head>
<body>

    <div class="struk-wrapper">
        <div class="receipt-card">
            <div class="text-center">
                <div class="store-icon">🧾</div>
                <div class="store-name">MILAN POS</div>
                <div class="store-tagline">Terima kasih telah berbelanja</div>
            </div>

            <hr class="divider">

            <div class="info-grid">
                <div class="info-item">
                    <small>No. Transaksi</small>
                    <strong>#TRX-<?php echo e($penjualan->id); ?></strong>
                </div>
                <div class="info-item">
                    <small>Tanggal</small>
                    <strong><?php echo e($penjualan->created_at ? $penjualan->created_at->format('d M Y, H:i') : '-'); ?></strong>
                </div>
                <div class="info-item">
                    <small>Kasir</small>
                    <strong><?php echo e($penjualan->user->name ?? '-'); ?></strong>
                </div>
                <div class="info-item">
                    <small>Metode Pembayaran</small>
                    <span class="badge-status"><?php echo e(strtoupper($penjualan->metode_pembayaran ?? 'CASH')); ?></span>
                </div>
            </div>

            <hr class="divider">

            <table>
                <thead>
                    <tr>
                        <th>Item</th>
                        <th class="text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $penjualan->itemPenjualan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <span class="item-name"><?php echo e($item->produk->nama ?? '-'); ?></span>
                            <span class="item-sub">
                                <?php echo e($item->kuantitas); ?> x Rp <?php echo e(number_format($item->harga_satuan ?? $item->harga ?? 0, 0, ',', '.')); ?>

                            </span>
                        </td>
                        <td class="text-right item-subtotal">
                            Rp <?php echo e(number_format($item->subtotal ?? 0, 0, ',', '.')); ?>

                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>

            <div class="total-box">
                <span class="total-label">TOTAL PEMBAYARAN</span>
                <span class="total-amount">Rp <?php echo e(number_format($penjualan->total_pembayaran ?? 0, 0, ',', '.')); ?></span>
            </div>

            <div class="footer-note">
                *** Struk ini sah tanpa tanda tangan ***
            </div>
        </div>
    </div>

    <div class="btn-group">
        <button onclick="window.print()" class="btn-print">🖨️ Cetak Struk</button>
        <a href="<?php echo e(route('penjualan.index')); ?>" class="btn-back">Kembali</a>
    </div>

</body>
</html><?php /**PATH C:\laragon\www\zahiraaa_poss\resources\views/penjualan/struk.blade.php ENDPATH**/ ?>