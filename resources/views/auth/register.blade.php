@extends('layouts.guest')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    .login-page {
        min-height: 100vh;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 24px;
        overflow: hidden;
        background-image: url("{{ asset('image/background.jpeg') }}");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .login-page::before {
        content: "";
        position: absolute;
        inset: 0;
        background:
            linear-gradient(135deg, rgba(7,15,35,.86), rgba(10,44,86,.64)),
            rgba(0,0,0,.45);
        z-index: 1;
    }

    .login-card {
        position: relative;
        z-index: 2;
        width: 100%;
        max-width: 430px;
        padding: 34px 30px;
        color: #fff;
        border: 1px solid rgba(255,255,255,.24);
        border-radius: 20px;
        background: rgba(255,255,255,.16);
        box-shadow: 0 24px 70px rgba(0,0,0,.35);
        backdrop-filter: blur(18px);
        -webkit-backdrop-filter: blur(18px);
    }

    .shop-icon {
        width: 76px;
        height: 76px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
        border-radius: 20px;
        color: #fff;
        font-size: 42px;
        background: rgba(255,255,255,.18);
        border: 1px solid rgba(255,255,255,.24);
    }

    .brand-title {
        margin-bottom: 4px;
        font-size: 30px;
        font-weight: 800;
    }

    .brand-subtitle {
        margin-bottom: 10px;
        color: rgba(255,255,255,.86);
        font-size: 16px;
        font-weight: 600;
    }

    .brand-description {
        color: rgba(255,255,255,.72);
        font-size: 14px;
    }

    .form-label {
        color: rgba(255,255,255,.9);
        font-weight: 600;
    }

    .input-group-text {
        color: #0d6efd;
        background: rgba(255,255,255,.94);
        border: 0;
        border-radius: 16px 0 0 16px;
    }

    .form-control {
        min-height: 50px;
        border: 0;
        background: rgba(255,255,255,.94);
        border-radius: 0 16px 16px 0;
    }

    .form-control:focus {
        background: #fff;
        box-shadow: 0 0 0 .25rem rgba(13,110,253,.25);
    }

    .btn-login {
        min-height: 50px;
        border: 0;
        border-radius: 18px;
        font-weight: 700;
        color: #fff;
        background: linear-gradient(135deg,#0d6efd,#0a58ca);
    }

    .btn-login:hover {
        color: #fff;
        background: linear-gradient(135deg,#2483ff,#084db4);
    }

    .forgot-link {
        color: rgba(255,255,255,.85);
        text-decoration: none;
    }

    .forgot-link:hover {
        color: #fff;
        text-decoration: underline;
    }

    .invalid-feedback {
        color: #ffd2d2;
    }
</style>

<div class="login-page">
    <div class="login-card">

        <div class="text-center mb-4">
            <div class="shop-icon">
                <i class="bi bi-shop"></i>
            </div>

            <h1 class="brand-title">Warung Restock</h1>
            <div class="brand-subtitle">Daftar Akun Baru</div>
            <p class="brand-description">
                Silakan isi data di bawah untuk membuat akun.
            </p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-person"></i>
                    </span>
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        class="form-control @error('name') is-invalid @enderror"
                        placeholder="Masukkan nama"
                        required
                        autofocus>

                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-envelope"></i>
                    </span>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="form-control @error('email') is-invalid @enderror"
                        placeholder="nama@gmail.com"
                        required>

                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-lock"></i>
                    </span>
                    <input
                        type="password"
                        name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Masukkan password"
                        required>

                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Konfirmasi Password</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-shield-lock"></i>
                    </span>
                    <input
                        type="password"
                        name="password_confirmation"
                        class="form-control"
                        placeholder="Ulangi password"
                        required>
                </div>
            </div>

            <button type="submit" class="btn btn-login w-100">
                <i class="bi bi-person-plus me-2"></i>
                Daftar
            </button>

            <div class="text-center mt-3">
                <a href="{{ route('login') }}" class="forgot-link">
                    Sudah punya akun? Login
                </a>
            </div>

        </form>

    </div>
</div>
@endsection