<nav class="navbar navbar-expand-lg border-bottom shadow-sm sticky-top" style="background-color: #FAF3E0; border-color: #E6D7BC !important;">
  <div class="container-fluid px-4">
    
    {{-- Logo POS mengarah ke Dashboard --}}
    <a class="navbar-brand font-weight-bold d-flex align-items-center" href="{{ route('dashboard') }}" style="color: #4A3E3D; font-weight: 700;">
     <img src="{{ asset('images/logo-milan.webp') }}" alt="Logo Milann POS" style="height: 48px; width: 48px; object-fit: cover; border-radius: 50%; margin-right: 8px;">
     <span style="color: #4A3E3D; font-weight: 700; margin-left: 8px;">MilanMart</span>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-1">
        
        {{-- Menu Dashboard --}}
        <li class="nav-item">
          <a class="nav-link px-3 py-2 rounded-3 text-dark font-medium d-inline-flex align-items-center gap-2 {{ Request::is('dashboard*') ? 'active-cream' : '' }}" href="{{ route('dashboard') }}" style="color: #5C4D42 !important;">
            <i class="bi bi-speedometer2"></i>
            <span>Dashboard</span>
          </a>
        </li> 

        {{-- Menu Users --}}
        <li class="nav-item">
          <a class="nav-link px-3 py-2 rounded-3 text-dark font-medium d-inline-flex align-items-center gap-2 {{ Request::is('admin/users*') ? 'active-cream' : '' }}" href="{{ route('admin.users') }}" style="color: #5C4D42 !important;">
            <i class="bi bi-people"></i>
            <span>Users</span>
          </a>
        </li>

         {{-- Menu Jenis Makanan --}}
        <li class="nav-item">
          <a class="nav-link px-3 py-2 rounded-3 text-dark font-medium d-inline-flex align-items-center gap-2 {{ Request::is('jenis-makanan*') ? 'active-cream' : '' }}" href="{{ route('jenis-makanan.index') }}" style="color: #5C4D42 !important;">
            <i class="bi bi-egg-fried"></i>
            <span>Jenis</span>
          </a>
        </li>

        {{-- Menu Produk --}}
        <li class="nav-item">
          <a class="nav-link px-3 py-2 rounded-3 text-dark font-medium d-inline-flex align-items-center gap-2 {{ Request::is('produk*') ? 'active-cream' : '' }}" href="{{ route('produk.index') }}" style="color: #5C4D42 !important;">
            <i class="bi bi-box-seam"></i>
            <span>Produk</span>
          </a>
        </li>

        {{-- Menu Penjualan --}}
        <li class="nav-item">
          <a class="nav-link px-3 py-2 rounded-3 text-dark font-medium d-inline-flex align-items-center gap-2 {{ Request::is('penjualan*') ? 'active-cream' : '' }}" href="{{ route('penjualan.index') }}" style="color: #5C4D42 !important;">
            <i class="bi bi-cart3"></i>
            <span>Penjualan</span>
          </a>
        </li>

        {{-- Menu Tentang --}}
        <li class="nav-item">
          <a class="nav-link px-3 py-2 rounded-3 text-dark font-medium d-inline-flex align-items-center gap-2 {{ Request::is('tentang*') ? 'active-cream' : '' }}" href="{{ route('tentang') }}" style="color: #5C4D42 !important;">
            <i class="bi bi-info-circle"></i>
            <span>Tentang</span>
          </a>
        </li>
      </ul>

      {{-- Form Logout --}}
      <form action="{{ route('logout') }}" method="POST" class="d-flex ms-auto">
        @csrf
        <button type="submit" class="btn px-3 py-2 btn-sm rounded-3 shadow-sm font-weight-bold d-inline-flex align-items-center gap-1" style="background-color: #F7EBEB; color: #8C3A3A; border: 1px solid #E5C3C3;">
          <i class="bi bi-box-arrow-right"></i> Logout
        </button>
      </form>
    </div>
  </div>
</nav>

{{-- Style Hover & Active --}}
<style>
  .nav-link:hover, .nav-link.active-cream {
    background-color: #EFE3C3 !important;
    color: #2C221E !important;
    font-weight: 600;
  }
</style>