@extends('layouts.app')

@section('title', 'Tambah Jenis Makanan')

@section('content')

<style>
body { background-color: #fff8ed; }
.form-container {
    background:#fff3dc;
    padding:25px;
    border-radius:20px;
    box-shadow:0 5px 15px rgba(107,66,38,.1);
    max-width: 500px;
    margin: 0 auto;
}
.page-title { color:#6b4226; font-weight:800; }
.btn-save {
    background:#8b5e34;
    color:white;
    border-radius:10px;
    padding:10px 20px;
    border:none;
}
.btn-save:hover { background:#6f451f; color:white; }
</style>

<div class="container my-4">
    <div class="form-container">
        <h1 class="page-title mb-4">Tambah Jenis Makanan</h1>

        <form action="{{ route('jenis-makanan.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Jenis</label>
                <input type="text" name="nama" value="{{ old('nama') }}" class="form-control" required>
                @error('nama') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
            </div>
            
            <button type="submit" class="btn btn-save">Simpan</button>
            <a href="{{ route('jenis-makanan.index') }}" class="ms-2 text-muted">Batal</a>
        </form>
    </div>
</div>

@endsection