

<?php $__env->startSection('title', 'Login'); ?>

<?php $__env->startSection('content'); ?>
<style>
    body {
        background-color: #F5EFE6 !important;
    }
    .login-card {
        background-color: #FFFDF8;
    }
    .login-icon-circle {
        background-color: #B08968 !important;
    }
    .btn-cream {
        background-color: #B08968;
        border-color: #B08968;
        color: #fff;
    }
    .btn-cream:hover,
    .btn-cream:focus {
        background-color: #9C7A5C;
        border-color: #9C7A5C;
        color: #fff;
    }
    .form-control:focus {
        border-color: #B08968;
        box-shadow: 0 0 0 0.25rem rgba(176, 137, 104, 0.25);
    }
</style>

<div class="container min-vh-100 d-flex justify-content-center align-items-center">
    <div class="card login-card border-0 shadow-lg rounded-4" style="width: 100%; max-width: 420px;">
        <div class="card-body p-4 p-sm-5">
            
            
            <div class="text-center mb-4">
                <div class="login-icon-circle text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                    <i class="bi bi-person-fill fs-2"></i> 
                </div>
                <h3 class="fw-bold mb-1 text-dark">Login POS</h3>
                <p class="text-muted small">Masukkan kredensial Anda untuk masuk</p>
            </div>

            
            <form action="<?php echo e(route('auth')); ?>" method="POST">
                <?php echo csrf_field(); ?>

                
                <div class="form-floating mb-3">
                    <input
                        type="email"
                        name="email"
                        value="<?php echo e(old('email')); ?>"
                        class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        id="floatingEmail"
                        placeholder="name@example.com"
                        required>
                    <label for="floatingEmail">Email Address</label>

                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback">
                            <?php echo e($message); ?>

                        </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="form-floating mb-4">
                    <input
                        type="password"
                        name="password"
                        class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        id="floatingPassword"
                        placeholder="Password"
                        required>
                    <label for="floatingPassword">Password</label>

                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback">
                            <?php echo e($message); ?>

                        </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <button type="submit" class="btn btn-cream w-100 py-2.5 rounded-3 fw-bold fs-6 shadow-sm">
                    Login
                </button>
            </form>
            <div class="text-center mt-3">
    <img src="<?php echo e(asset('images/logosmkn4.png')); ?>" alt="Logo SMKN 4" style="height: 28px; width: 28px; object-fit: contain; margin-bottom: 4px;">
    <p style="font-size: 12px; color: #A08770; margin: 0;">
        by Milan &middot; SMKN 4
    </p>
</div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\MILANNN_POSS\resources\views/login.blade.php ENDPATH**/ ?>