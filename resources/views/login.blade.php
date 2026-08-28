@extends('layouts.app')

@section('title', 'Login')

@section('content')
<style>
    body {
        background-color: #F5EFE6 !important;
    }
    .login-card {
        background-color: #FFFDF8;
    }
    .login-icon-circle {
        background-color: #B08968 !important;
    }
    .btn-cream {
        background-color: #B08968;
        border-color: #B08968;
        color: #fff;
    }
    .btn-cream:hover,
    .btn-cream:focus {
        background-color: #9C7A5C;
        border-color: #9C7A5C;
        color: #fff;
    }
    .form-control:focus {
        border-color: #B08968;
        box-shadow: 0 0 0 0.25rem rgba(176, 137, 104, 0.25);
    }
</style>

<div class="container min-vh-100 d-flex justify-content-center align-items-center">
    <div class="card login-card border-0 shadow-lg rounded-4" style="width: 100%; max-width: 420px;">
        <div class="card-body p-4 p-sm-5">
            
            {{-- Header/Logo --}}
            <div class="text-center mb-4">
                <div class="login-icon-circle text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                    <i class="bi bi-person-fill fs-2"></i> {{-- Bisa diganti ikon/logo POS --}}
                </div>
                <h3 class="fw-bold mb-1 text-dark">Login POS</h3>
                <p class="text-muted small">Masukkan kredensial Anda untuk masuk</p>
            </div>

            {{-- Form Login --}}
            <form action="{{ route('auth') }}" method="POST">
                @csrf

                {{-- Input Email --}}
                <div class="form-floating mb-3">
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="form-control @error('email') is-invalid @enderror"
                        id="floatingEmail"
                        placeholder="name@example.com"
                        required>
                    <label for="floatingEmail">Email Address</label>

                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Input Password --}}
                <div class="form-floating mb-4">
                    <input
                        type="password"
                        name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        id="floatingPassword"
                        placeholder="Password"
                        required>
                    <label for="floatingPassword">Password</label>

                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Tombol Login --}}
                <button type="submit" class="btn btn-cream w-100 py-2.5 rounded-3 fw-bold fs-6 shadow-sm">
                    Login
                </button>
            </form>
            <div class="text-center mt-3">
    <img src="{{ asset('images/logosmkn4.png') }}" alt="Logo SMKN 4" style="height: 28px; width: 28px; object-fit: contain; margin-bottom: 4px;">
    <p style="font-size: 12px; color: #A08770; margin: 0;">
        by Milan &middot; SMKN 4
    </p>
</div>
        </div>
    </div>
</div>
@endsection