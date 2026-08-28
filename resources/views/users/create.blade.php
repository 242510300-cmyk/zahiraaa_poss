@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm" style="background-color:#fdf6ec; border: 1px solid #d8c3a5;">
        <div class="card-body p-4">
            <h2 class="mb-4" style="color:#6f4e37;">Tambah User</h2>

            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label" style="color:#6f4e37;">Nama</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label" style="color:#6f4e37;">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label" style="color:#6f4e37;">Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="role_id" class="form-label" style="color:#6f4e37;">Role</label>
                    <select name="role_id" id="role_id" class="form-select">
                        <option value="">-- Pilih Role --</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn" style="background-color:#6f4e37; color:#fff;">Simpan</button>
               <a href="{{ route('admin.users') }}" class="btn" style="background-color:#a9a9a9; color:#fff;">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection