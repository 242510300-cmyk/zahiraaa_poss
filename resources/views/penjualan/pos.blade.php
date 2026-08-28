@extends('layouts.app')

@section('title', 'POS - Kasir')

@section('content')

<style>
    .pos-card {
        background-color: #fdf6ec;
        border: 1px solid #d8c3a5 !important;
    }

    .pos-card .table-light th {
        background-color: #f5ead9;
        color: #6b4226;
    }

    .pos-search input.form-control {
        border: 1px solid #d8c3a5;
    }

    .pos-search .input-group-text {
        border: 1px solid #d8c3a5;
        border-right: none;
    }

    .produk-row {
        border-bottom: 1px solid #e5dcc9 !important;
    }

    .produk-row:hover {
        background-color: #f9f1e4;
    }

    .btn-tambah-produk {
        background-color: #6b4226;
        border: none;
        color: #fff;
    }

    .btn-tambah-produk:hover {
        background-color: #55341d;
        color: #fff;
    }

    .btn-tambah-produk.disabled {
        background-color: #b7a48d;
    }

    .card-footer.pos-footer {
        background-color: #fdf6ec !important;
        border-top: 1px solid #d8c3a5 !important;
    }

    .total-bayar-label {
        color: #6b4226;
    }

    .total-bayar-value {
        color: #6b4226 !important;
    }

    .btn-checkout {
        background-color: #2e7d32;
        border: none;
        color: #fff;
    }

    .btn-checkout:hover {
        background-color: #256428;
        color: #fff;
    }

    .btn-checkout.disabled {
        background-color: #9bb99d;
    }

    .btn-batalkan {
        border: 1px solid #c0392b;
        color: #c0392b;
        background-color: #fff;
    }

    .btn-batalkan:hover {
        background-color: #fdecea;
        color: #c0392b;
    }

    select.form-select {
        border: 1px solid #d8c3a5;
    }
</style>

{{-- Alert Notifikasi --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('errors'))
    <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
        {{ session('errors') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif      

<h4 class="mb-3 fw-bold" style="color: #6b4226;">Tambah dan Edit Transaksi</h4>

<div class="row">

    {{-- ================== DAFTAR PRODUK (KIRI) ================== --}}
    <div class="col-md-6">
        <div class="card pos-card shadow-sm border-0 rounded-3">
            <div class="card-body" style="max-height:72vh; overflow-y:auto">

                {{-- Search Box --}}
                <div class="mb-3 pos-search">
                    <form method="GET" action="">
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                class="form-control"
                                placeholder="Cari nama produk..."
                            >
                        </div>
                    </form>
                </div>

                {{-- List Produk --}}
                @forelse($products as $product)
                <form method="POST" action="{{ route('penjualan.addItem', $sale->id) }}" class="row g-2 align-items-center mb-2 p-2 rounded produk-row">
                    @csrf
                    <input type="hidden" name="produk_id" value="{{ $product->id }}">

                    {{-- Detail Card Produk --}}
                    <div class="col-7">
                        <div class="d-flex align-items-center gap-2">
                            <img
                                src="{{ $product->foto ? asset('storage/'.$product->foto) : 'https://via.placeholder.com/45' }}"
                                alt="{{ $product->nama }}"
                                class="rounded-circle border"
                                style="width:45px; height:45px; object-fit:cover;"
                            >

                            <div>
                                <div class="fw-semibold text-dark text-truncate" style="max-width: 170px;">
                                    {{ $product->nama }}
                                </div>
                                <small class="text-muted d-block">
                                    Rp {{ number_format($product->harga ?? $product->harga_jual ?? 0, 0, ',', '.') }}
                                </small>
                            </div>
                        </div>
                    </div>

                    {{-- Input Quantity --}}
                    <div class="col-3">
                        <input
                            type="number"
                            name="quantity"
                            value="1"
                            min="1"
                            max="{{ $product->stok }}"
                            class="form-control text-center"
                            {{ isset($sale) && $sale->status === 'COMPLETED' ? 'readonly' : '' }}
                        >
                    </div>

                    {{-- Tombol + --}}
                    <div class="col-2">
                        <button
                            type="submit"
                            class="btn btn-tambah-produk w-100 fw-bold
                            {{ isset($sale) && $sale->status === 'COMPLETED' ? 'disabled' : '' }}"
                        >
                            +
                        </button>
                    </div>

                </form>
                @empty
                    <div class="text-center text-muted py-4">
                        <i class="bi bi-box-seam fs-2 d-block mb-2"></i>
                        Produk tidak ditemukan.
                    </div>
                @endforelse

            </div>
        </div>
    </div>


    {{-- ================== KERANJANG BELANJA (KANAN) ================== --}}
    <div class="col-md-6">
        <div class="card pos-card shadow-sm border-0 rounded-3">

            <div class="table-responsive" style="min-height: 250px;">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th width="80">Qty</th>
                            <th>Subtotal</th>
                            <th width="60" class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($sale->itemPenjualan as $item)
                        <tr>
                            <td class="fw-medium">{{ $item->produk->nama ?? 'Produk Dihapus' }}</td>
                            <td>Rp {{ number_format($item->harga ?? $item->produk->harga_jual ?? 0, 0, ',', '.') }}</td>
                            
                            {{-- Edit Qty Langsung --}}
                            <td>
                                <form method="POST" action="{{ route('itempenjualan.update', $item->id) }}">
                                    @csrf 
                                    @method('PUT')
                                    <input
                                        type="number"
                                        name="kuantitas"
                                        value="{{ $item->kuantitas }}"
                                        min="1"
                                        class="form-control form-control-sm text-center"
                                        onchange="this.form.submit()"
                                        {{ $sale->status === 'COMPLETED' ? 'readonly' : '' }}
                                    >
                                </form>
                            </td>

                            <td class="fw-bold text-success">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>

                            {{-- Tombol Hapus Item --}}
                            <td class="text-center">
                                @if($sale->status !== 'COMPLETED')
                                <form method="POST" action="{{ route('itempenjualan.destroy', $item->id) }}">
                                    @csrf 
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm border-0" title="Hapus Item">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-5">
                                <i class="bi bi-cart-x fs-1 d-block mb-2 text-secondary"></i>
                                Keranjang masih kosong
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Ringkasan & Form Checkout --}}
            <div class="card-footer pos-footer p-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="fs-5 fw-bold total-bayar-label">Total Bayar:</span>
                    <span class="fs-4 fw-bold total-bayar-value">
                        Rp {{ number_format($sale->itemPenjualan->sum('subtotal'), 0, ',', '.') }}
                    </span>
                </div>

                <form method="POST"
                      action="{{ route('penjualan.update', $sale->id) }}"
                      onsubmit="return confirm('Yakin ingin checkout transaksi ini?')" 
                      class="mt-2">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <select name="payment_method" class="form-select" required {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}>
                            <option value="">-- Pilih Metode Pembayaran --</option>
                            <option value="CASH">Cash (Tunai)</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-checkout w-100 fw-bold py-2 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                        <i class="bi bi-check-circle me-1"></i> Checkout Sekarang
                    </button>
                </form>

                {{-- Batalkan Transaksi --}}
                @if($sale->status !== 'COMPLETED')
                <form action="{{ route('penjualan.destroy', $sale->id) }}"
                      method="POST"
                      onsubmit="return confirm('Yakin ingin membatalkan transaksi ini? Stok akan dikembalikan.')">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-batalkan w-100 mt-2">
                        <i class="bi bi-x-circle me-1"></i> Batalkan Transaksi
                    </button>
                </form>
                @endif

            </div>

        </div>
    </div>

</div>

@endsection