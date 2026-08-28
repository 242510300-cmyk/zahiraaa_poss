<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'POS Milan'); ?></title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #FAF8F5;
        }
    </style>
</head>
<body class="min-h-screen text-slate-800 flex flex-col">

    
    
<?php if(!Request::is('penjualan/create*') 
    && !Request::is('penjualan/pos*') 
    && !Request::is('admin/users/create*') 
    && !Request::is('admin/users/*/edit*') 
    && !Request::is('login*') 
    && !Request::is('register*')): ?>
    <?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php endif; ?>

    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <?php if(session('success')): ?>
            <div class="mb-6 p-4 text-sm text-[#3C6430] bg-[#EAF5E5] border border-[#C5E3B8] rounded-2xl shadow-sm flex items-center justify-between">
                <span><?php echo e(session('success')); ?></span>
            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="mb-6 p-4 text-sm text-[#8C3A3A] bg-[#F7EBEB] border border-[#E5C3C3] rounded-2xl shadow-sm flex items-center justify-between">
                <span><?php echo e(session('error')); ?></span>
            </div>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>
    </main>

</body>
</html><?php /**PATH C:\laragon\www\MIMIL_POS\resources\views/layouts/app.blade.php ENDPATH**/ ?>