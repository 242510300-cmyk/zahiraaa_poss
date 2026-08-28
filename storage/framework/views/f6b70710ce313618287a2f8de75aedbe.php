

<?php $__env->startSection('title', 'Tambah User'); ?>

<?php $__env->startSection('content'); ?>
    <h4>Tambah User</h4>

    <form action="<?php echo e(route('admin.users.store')); ?>" method="POST">
        <?php echo $__env->make('users._form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\MILANNN_POSS\resources\views/users/create.blade.php ENDPATH**/ ?>