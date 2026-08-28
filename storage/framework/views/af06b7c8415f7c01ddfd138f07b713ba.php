

<?php $__env->startSection('title', 'Tambah Produk'); ?>

<?php $__env->startSection('content'); ?>


<style>
    nav.navbar {
        display: none !important;
    }

    .card-produk {
        background-color: #fdf6ec;
        border: 1px solid #d8c3a5;
        border-radius: 10px;
        padding: 24px;
        max-width: 600px;
    }

    .card-produk label {
        color: #6f4e37;
        font-weight: 500;
        margin-bottom: 6px;
        display: block;
    }

    .card-produk .form-control,
    .card-produk .form-select,
    .card-produk input[type="file"] {
        margin-bottom: 16px;
        border: 1px solid #d8c3a5;
    }

    .card-produk .form-control:focus,
    .card-produk .form-select:focus {
        border-color: #6f4e37;
        box-shadow: 0 0 0 0.2rem rgba(111, 78, 55, 0.15);
    }

    .btn-simpan {
        background-color: #6f4e37;
        color: #fff;
        border: none;
    }

    .btn-simpan:hover {
        background-color: #5a3e2b;
        color: #fff;
    }

    .btn-kembali {
        background-color: #a9a9a9;
        color: #fff;
        border: none;
    }

    .preview-foto {
        background-color: #fdf6ec;
        border: 1px dashed #d8c3a5;
        border-radius: 10px;
        padding: 16px;
        color: #6f4e37;
        min-height: 200px;
    }
</style>

<h4 style="color:#6f4e37;">Tambah Produk</h4>

<div class="card-produk">
    <form action="<?php echo e(route('produk.store')); ?>" 
          method="POST"
          enctype="multipart/form-data">
        <?php echo $__env->make('Produk._form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </form>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\MIMIL_POS\resources\views/produk/create.blade.php ENDPATH**/ ?>