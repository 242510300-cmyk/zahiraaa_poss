<?php $__env->startSection('title', 'Produk'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


<style>

body {
    background-color: #fff8ed;
}


.product-container {

    background:#fff3dc;
    padding:25px;
    border-radius:20px;
    box-shadow:0 5px 15px rgba(107,66,38,.1);

}


.page-title {

    color:#6b4226;
    font-weight:800;

}


/* Tombol */

.btn-create {

    background:#8b5e34;
    color:white;
    border-radius:10px;
    padding:10px 20px;
    border:none;

}


.btn-create:hover {

    background:#6f451f;
    color:white;

}



.btn-edit {

    background:#d9a441;
    color:white;
    border-radius:8px;

}


.btn-edit:hover {

    background:#b8862c;
    color:white;

}



.btn-delete {

    background:#b85450;
    color:white;
    border-radius:8px;

}


.btn-delete:hover {

    background:#913c39;
    color:white;

}




.search-box {

    background:white;
    border-radius:10px;
    padding:8px;

}




.table-card {

    background:white;
    border-radius:15px;
    overflow:hidden;
    box-shadow:0 5px 15px rgba(0,0,0,.08);

}



.table thead {

    background:#8b5e34;
    color:white;

}



.table tbody tr:hover {

    background:#fff1d6;

}



.product-img {

    width:80px;
    height:80px;
    object-fit:cover;
    border-radius:10px;
    border:3px solid #f1dfc2;

}


.badge-stock {

    background:#d9a441;
    color:white;
    padding:7px 12px;
    border-radius:20px;

}


/* Perbaikan agar semua kolom sejajar rapi */
.table th,
.table td {
    vertical-align: middle;
    text-align: left;
    padding: 14px 16px;
}

.table td:first-child,
.table th:first-child {
    text-align: center;
}


</style>




<div class="container my-4">


<div class="product-container">



<div class="d-flex justify-content-between align-items-center mb-4">


<h1 class="page-title">
    📦 Halaman Produk
</h1>



<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', App\Models\Produk::class)): ?>

<a href="<?php echo e(route('produk.create')); ?>"
   class="btn btn-create">

    + Tambah Produk

</a>

<?php endif; ?>


</div>







<form action="<?php echo e(route('produk.index')); ?>" method="GET" class="mb-4">


<div class="input-group search-box">


<input
type="text"
name="search"
value="<?php echo e(request('search')); ?>"
class="form-control"
placeholder="Cari nama produk..."
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
<th>User</th>
<th>Foto</th>
<th>Nama</th>
<th>Jenis</th>
<th>Harga Beli</th>
<th>Harga Jual</th>
<th>Stok</th>
<th>Aksi</th>

</tr>


</thead>




<tbody>


<?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>


<tr>


<td>

<?php echo e($products->firstItem() + $loop->index); ?>


</td>



<td>

<?php echo e($product->user->name ?? 'N/A'); ?>


</td>




<td>


<?php if($product->foto): ?>

<img src="<?php echo e(asset('storage/'.$product->foto)); ?>"
     class="product-img"
     alt="<?php echo e($product->nama); ?>">


<?php else: ?>

<span class="text-muted">
Tidak ada foto
</span>

<?php endif; ?>


</td>





<td>

<strong>
<?php echo e($product->nama); ?>

</strong>

</td>




<td>

<?php echo e($product->category ?? '-'); ?>


</td>




<td>

Rp <?php echo e(number_format($product->harga_beli,0,',','.')); ?>


</td>



<td>

Rp <?php echo e(number_format($product->harga_jual,0,',','.')); ?>


</td>




<td>


<span class="badge-stock">

<?php echo e($product->stok); ?>


</span>


</td>




<td>


<div class="d-flex gap-2">



<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $product)): ?>

<a href="<?php echo e(route('produk.edit',$product)); ?>"
class="btn btn-sm btn-edit">

✏ Edit

</a>

<?php endif; ?>





<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $product)): ?>

<form action="<?php echo e(route('produk.destroy',$product)); ?>"
method="POST">


<?php echo csrf_field(); ?>
<?php echo method_field('DELETE'); ?>


<button class="btn btn-sm btn-delete"
onclick="return confirm('Apakah anda yakin menghapus produk ini?')">

🗑 Hapus

</button>


</form>


<?php endif; ?>



</div>


</td>



</tr>




<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>


<tr>

<td colspan="9" class="text-center py-4 text-muted">

<h5>
Data produk tidak tersedia
</h5>

</td>

</tr>


<?php endif; ?>



</tbody>


</table>


</div>





<div class="mt-3">

<?php echo e($products->appends(request()->query())->links()); ?>


</div>




</div>


</div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\POS_MILANNNN-main\POS_MILANNNN-main\resources\views/produk/index.blade.php ENDPATH**/ ?>