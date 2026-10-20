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
                linear-gradient(135deg, rgba(7, 15, 35, .86), rgba(10, 44, 86, .64)),
                rgba(0, 0, 0, .45);
            z-index: 1;
        }

        .login-card {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 430px;
            padding: 34px 30px;
            color: #fff;
            border: 1px solid rgba(255, 255, 255, .24);
            border-radius: 20px;
            background: rgba(255, 255, 255, .16);
            box-shadow: 0 24px 70px rgba(0, 0, 0, .35);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
        }

        .login-card:hover {
            transform: translateY(-6px);
            border-color: rgba(255, 255, 255, .36);
            box-shadow: 0 30px 85px rgba(0, 0, 0, .45);
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
            background: rgba(255, 255, 255, .18);
            border: 1px solid rgba(255, 255, 255, .24);
            box-shadow: 0 14px 35px rgba(0, 0, 0, .22);
        }

        .brand-title {
            margin-bottom: 4px;
            font-size: 30px;
            font-weight: 800;
            letter-spacing: 0;
        }

        .brand-subtitle {
            margin-bottom: 10px;
            color: rgba(255, 255, 255, .86);
            font-size: 16px;
            font-weight: 600;
        }

        .brand-description {
            color: rgba(255, 255, 255, .72);
            font-size: 14px;
        }

        .form-label {
            color: rgba(255, 255, 255, .9);
            font-weight: 600;
            font-size: 14px;
        }

        .input-group-text {
            color: #0d6efd;
            background: rgba(255, 255, 255, .94);
            border: 0;
            border-radius: 16px 0 0 16px;
        }

        .form-control {
            min-height: 50px;
            color: #1f2937;
            background: rgba(255, 255, 255, .94);
            border: 0;
            border-radius: 0 16px 16px 0;
            box-shadow: none;
        }

        .form-control:focus {
            background: #fff;
            box-shadow: 0 0 0 .25rem rgba(13, 110, 253, .25);
        }

        .form-control::placeholder {
            color: #8a94a6;
        }

        .form-check-label,
        .forgot-link {
            color: rgba(255, 255, 255, .82);
            font-size: 14px;
        }

        .forgot-link {
            text-decoration: none;
            transition: color .2s ease;
        }

        .forgot-link:hover {
            color: #fff;
            text-decoration: underline;
        }

        .btn-login {
            min-height: 50px;
            border: 0;
            border-radius: 18px;
            font-weight: 700;
            color: #fff;
            background: linear-gradient(135deg, #0d6efd, #0a58ca);
            box-shadow: 0 14px 32px rgba(13, 110, 253, .34);
            transition: transform .2s ease, box-shadow .2s ease, background .2s ease;
        }

        .btn-login:hover {
            color: #fff;
            transform: translateY(-2px);
            background: linear-gradient(135deg, #2483ff, #084db4);
            box-shadow: 0 18px 38px rgba(13, 110, 253, .46);
        }

        .toggle-password {
    background: rgba(255,255,255,.94);
    border: 0;
    border-radius: 0 16px 16px 0;
}

.toggle-password:hover {
    background: #fff;
}

        .invalid-feedback {
            color: #ffd2d2;
            font-weight: 500;
        }

        @media (max-width: 575.98px) {
            .login-page {
                padding: 18px;
            }

            .login-card {
                padding: 28px 22px;
                border-radius: 18px;
            }

            .brand-title {
                font-size: 26px;
            }

            .shop-icon {
                width: 68px;
                height: 68px;
                font-size: 38px;
            }
        }
    </style>

    <div class="login-page">
        <div class="login-card">
            <div class="text-center mb-4">
                <div class="shop-icon">
                    <i class="bi bi-shop"></i>
                </div>

                <h1 class="brand-title">Warung Restock</h1>
                <div class="brand-subtitle">Sistem Restock Warung</div>
                <p class="brand-description mb-0">
                    Silakan login untuk mengelola stok barang warung.
                </p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="gmail" class="form-label">gmail</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-envelope"></i>
                        </span>
                        <input
                            id="gmail"
                            type="gmail"
                            name="email"
                            value="{{ old('gmail') }}"
                            class="form-control @error('gmail') is-invalid @enderror"
                            placeholder="nama@gmail.com"
                            required
                            autofocus
                            autocomplete="username"
                        >
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

               <div class="mb-2">
    <label for="password" class="form-label">Password</label>

    <div class="input-group">

        <span class="input-group-text">
            <i class="bi bi-lock"></i>
        </span>

        <input
            id="password"
            type="password"
            name="password"
            class="form-control @error('password') is-invalid @enderror"
            placeholder="Masukkan password"
            required
            autocomplete="current-password"
        >

        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

    </div>
</div>

                <div class="d-flex justify-content-between align-items-center gap-3 mb-4">
                    <div class="form-check">
                        <input
                        id="showPassword"
                        type="checkbox"
                      class="form-check-input"
>
                        <label class="form-check-label" for="showPassword">
                         Tampilkan Password
                        </label>
                    </div>

                    @if (Route::has('password.request'))
                        <a class="forgot-link" href="{{ route('password.request') }}">
                            Lupa Password?
                        </a>
                    @endif
                </div>

                <button type="submit" class="btn btn-login w-100">
                    <i class="bi bi-box-arrow-in-right me-2"></i>
                    Login
                </button>
            </form>
        </div>
    </div>
@endsection
