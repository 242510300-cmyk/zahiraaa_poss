<nav class="navbar navbar-expand-lg border-bottom shadow-sm sticky-top" style="background-color: #FAF3E0; border-color: #E6D7BC !important;">
  <div class="container-fluid px-4">
    
    
    <a class="navbar-brand font-weight-bold d-flex items-center" href="<?php echo e(route('dashboard')); ?>" style="color: #4A3E3D; font-weight: 700;">
      <img src="<?php echo e(asset('images/logo-sekolah.png')); ?>" alt="logo-sekolah" style="height: 32px; width: 32px; object-fit: contain; margin-right: 8px;">
      <span class="badge me-2" style="background-color: #8C6D58; color: white; padding: 6px 10px; border-radius: 8px;">POS</span>
      <span>MILAN</span>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-1">
        
        
        <li class="nav-item">
          <a class="nav-link px-3 py-2 rounded-3 text-dark font-medium <?php echo e(Request::is('dashboard*') ? 'active-cream' : ''); ?>" href="<?php echo e(route('dashboard')); ?>" style="color: #5C4D42 !important;">Dashboard</a>
        </li> 

        
        <li class="nav-item">
          <a class="nav-link px-3 py-2 rounded-3 text-dark font-medium <?php echo e(Request::is('admin/users*') ? 'active-cream' : ''); ?>" href="<?php echo e(route('admin.users')); ?>" style="color: #5C4D42 !important;">Users</a>
        </li>

        
        <li class="nav-item">
          <a class="nav-link px-3 py-2 rounded-3 text-dark font-medium <?php echo e(Request::is('produk*') ? 'active-cream' : ''); ?>" href="<?php echo e(route('produk.index')); ?>" style="color: #5C4D42 !important;">Produk</a>
        </li>

        
        <li class="nav-item">
          <a class="nav-link px-3 py-2 rounded-3 text-dark font-medium <?php echo e(Request::is('penjualan*') ? 'active-cream' : ''); ?>" href="<?php echo e(route('penjualan.index')); ?>" style="color: #5C4D42 !important;">Penjualan</a>
        </li>
      </ul>

      
      <form action="<?php echo e(route('logout')); ?>" method="POST" class="d-flex ms-auto">
        <?php echo csrf_field(); ?>
        <button type="submit" class="btn px-3 py-2 btn-sm rounded-3 shadow-sm font-weight-bold" style="background-color: #F7EBEB; color: #8C3A3A; border: 1px solid #E5C3C3;">
          <i class="bi bi-box-arrow-right me-1"></i> Logout
        </button>
      </form>
    </div>
  </div>
</nav>


<style>
  .nav-link:hover, .nav-link.active-cream {
    background-color: #EFE3C3 !important;
    color: #2C221E !important;
    font-weight: 600;
  }
</style><?php /**PATH C:\laragon\www\POS_MILANNNN-main\POS_MILANNNN-main\resources\views/layouts/navbar.blade.php ENDPATH**/ ?>