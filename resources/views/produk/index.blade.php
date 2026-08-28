@extends('layouts.app')

@section('title', 'Produk')

@section('content')

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

            @can('create', App\Models\Produk::class)
                <a href="{{ route('produk.create') }}" class="btn btn-create">
                    + Tambah Produk
                </a>
            @endcan
        </div>

        {{-- Search --}}
        <form action="{{ route('produk.index') }}" method="GET" class="mb-4">
            <div class="input-group search-box">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
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
                    @forelse ($products as $product)
                        <tr>
                            <td>
                                {{ $products->firstItem() + $loop->index }}
                            </td>

                            <td>
                                {{ $product->user->name ?? 'N/A' }}
                            </td>

                            <td>
                                @if($product->foto)
                                    <img src="{{ asset('storage/'.$product->foto) }}" class="product-img" alt="{{ $product->nama }}">
                                @else
                                    <span class="text-muted">Tidak ada foto</span>
                                @endif
                            </td>

                            <td>
                                <strong>{{ $product->nama }}</strong>
                            </td>

                            {{-- Bagian yang diperbaiki --}}
                            <td>
                                {{ $product->jenisMakanan->nama ?? '-' }}
                            </td>

                            <td>
                                Rp {{ number_format($product->harga_beli,0,',','.') }}
                            </td>

                            <td>
                                Rp {{ number_format($product->harga_jual,0,',','.') }}
                            </td>

                            <td>
                                <span class="badge-stock">
                                    {{ $product->stok }}
                                </span>
                            </td>

                            <td>
                                <div class="d-flex gap-2">
                                    @can('update', $product)
                                        <a href="{{ route('produk.edit',$product) }}" class="btn btn-sm btn-edit">
                                            ✏ Edit
                                        </a>
                                    @endcan

                                    @can('delete', $product)
                                        <form action="{{ route('produk.destroy',$product) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-delete" onclick="return confirm('Apakah anda yakin menghapus produk ini?')">
                                                🗑 Hapus
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-4 text-muted">
                                <h5>Data produk tidak tersedia</h5>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $products->appends(request()->query())->links() }}
        </div>
    </div>
</div>

@endsection