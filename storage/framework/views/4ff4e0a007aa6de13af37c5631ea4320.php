

<?php $__env->startSection('title', 'Users'); ?>

<?php $__env->startSection('content'); ?>

<style>
    body {
        background-color: #fff8ed;
    }

    .user-container {
        background: #fff3dc;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    }

    .page-title {
        color: #6b4226;
        font-weight: bold;
    }

    .btn-create {
        background-color: #8b5e34;
        color: white;
        border-radius: 10px;
        padding: 10px 20px;
        border: none;
    }

    .btn-create:hover {
        background-color: #6f451f;
        color: white;
    }

    .search-box {
        background: white;
        border-radius: 10px;
        padding: 10px;
    }

    .table-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,.08);
    }

    table thead {
        background-color: #8b5e34;
        color: white;
    }

    table tbody tr:hover {
        background-color: #fff1d6;
    }

    .btn-edit {
        background-color: #d9a441;
        color: white;
        border-radius: 8px;
    }

    .btn-edit:hover {
        background-color: #b8862c;
        color:white;
    }

    .btn-delete {
        background-color: #b85450;
        color:white;
        border-radius:8px;
    }

    .btn-delete:hover {
        background-color:#913c39;
        color:white;
    }

</style>


<div class="container mt-4">

    <div class="user-container">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h1 class="page-title">
                👥 Halaman Users
            </h1>

            <a href="<?php echo e(route('admin.users.create')); ?>" 
               class="btn btn-create">
                + Tambah user
            </a>

        </div>


        
        <form action="<?php echo e(route('admin.users')); ?>" method="GET" class="mb-4">

            <div class="input-group search-box">

                <input
                    type="text"
                    name="search"
                    value="<?php echo e(request('search')); ?>"
                    class="form-control"
                    placeholder="Cari username atau email..."
                >

                <button class="btn btn-outline-dark">
                    🔍 Cari
                </button>

            </div>

        </form>



        

        <div class="table-card">

            <table class="table table-hover align-middle mb-0">

                <thead>

                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>

                </thead>


                <tbody>


                <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                <tr>

                    <td>
                        <?php echo e($users->firstItem() + $loop->index); ?>

                    </td>


                    <td>
                        <strong>
                            <?php echo e($user->name); ?>

                        </strong>
                    </td>


                    <td>
                        <?php echo e($user->email); ?>

                    </td>


                    <td>

                        <span class="badge bg-warning text-dark">
                            <?php echo e($user->role->name ?? 'Tidak ada role'); ?>

                        </span>

                    </td>


                    <td>


                        <a href="<?php echo e(route('admin.users.edit', $user)); ?>"
                           class="btn btn-sm btn-edit">

                            ✏ Edit

                        </a>



                        <form action="<?php echo e(route('admin.users.destroy', $user)); ?>"
                              method="POST"
                              class="d-inline">

                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>


                            <button class="btn btn-sm btn-delete"
                                onclick="return confirm('Yakin hapus user ini?')">

                                🗑 Hapus

                            </button>


                        </form>


                    </td>


                </tr>


                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                <tr>

                    <td colspan="5" class="text-center text-muted py-4">

                        Data user belum tersedia

                    </td>

                </tr>

                <?php endif; ?>


                </tbody>


            </table>

        </div>


        <div class="mt-3">
            <?php echo e($users->links()); ?>

        </div>


    </div>

</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\zahiraaa_poss\resources\views/users/index.blade.php ENDPATH**/ ?>