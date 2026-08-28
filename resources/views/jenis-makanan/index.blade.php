@extends('layouts.app')

@section('title', 'Jenis Makanan')

@section('content')

<style>
body {
    background-color: #fff8ed;
}

.jenis-container {
    background:#fff3dc;
    padding:25px;
    border-radius:20px;
    box-shadow:0 5px 15px rgba(107,66,38,.1);
}

.page-title {
    color:#6b4226;
    font-weight:800;
}

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

.btn-kembali {
    background:#f1dfc2;
    color:#6b4226;
    border-radius:10px;
    padding:8px 16px;
    border:none;
    text-decoration:none;
    display:inline-block;
    margin-bottom:16px;
}
.btn-kembali:hover {
    background:#e6cda0;
    color:#6b4226;
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

.badge-kategori-makanan {
    background:#d9a441;
    color:white;
    padding:6px 12px;
    border-radius:20px;
    font-size: .85rem;
}
.badge-kategori-minuman {
    background:#5b8ab0;
    color:white;
    padding:6px 12px;
    border-radius:20px;
    font-size: .85rem;
}

.table th, .table td {
    vertical-align: middle;
    text-align: left;
    padding: 14px 16px;
}
</style>

<div class="container my-4">
    <div class="jenis-container">

        <a href="{{ route('dashboard') }}" class="btn-kembali">← Kembali</a>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="page-title">🍽️ Halaman Jenis Makanan</h1>
            <a href="{{ route('jenis-makanan.create') }}" class="btn btn-create">+ Tambah Jenis</a>
        </div>

        <div class="table-card">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jenisMakanans as $index => $jenis)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><strong>{{ $jenis->nama }}</strong></td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('jenis-makanan.edit', $jenis) }}" class="btn btn-sm btn-edit">✏ Edit</a>
                                <form action="{{ route('jenis-makanan.destroy', $jenis) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-delete">🗑 Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center py-4 text-muted">
                            <h5>Belum ada data.</h5>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection