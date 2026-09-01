

<?php $__env->startSection('title', 'Tambah Jenis Makanan'); ?>

<?php $__env->startSection('content'); ?>

<style>
body { background-color: #fff8ed; }
.form-container {
    background:#fff3dc;
    padding:25px;
    border-radius:20px;
    box-shadow:0 5px 15px rgba(107,66,38,.1);
    max-width: 500px;
    margin: 0 auto;
}
.page-title { color:#6b4226; font-weight:800; }
.btn-save {
    background:#8b5e34;
    color:white;
    border-radius:10px;
    padding:10px 20px;
    border:none;
}
.btn-save:hover { background:#6f451f; color:white; }
</style>

<div class="container my-4">
    <div class="form-container">
        <h1 class="page-title mb-4">Tambah Jenis Makanan</h1>

        <form action="<?php echo e(route('jenis-makanan.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Jenis</label>
                <input type="text" name="nama" value="<?php echo e(old('nama')); ?>" class="form-control" required>
                <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger small mt-1"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            
            <button type="submit" class="btn btn-save">Simpan</button>
            <a href="<?php echo e(route('jenis-makanan.index')); ?>" class="ms-2 text-muted">Batal</a>
        </form>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\zahiraaa_poss\resources\views/jenis-makanan/create.blade.php ENDPATH**/ ?>