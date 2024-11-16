@extends('layouts.master')

@section('css')
<style>
    body {
        background: url('{{ asset('images/archive_background.jpg') }}') no-repeat center center fixed;
        background-size: cover;
    }
    .login-card {
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        background: rgba(255, 255, 255, 0.9);
    }
    .login-header {
        background-color: #007bff;
        color: white;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        padding: 1rem;
        text-align: center;
    }
    .login-header h3 {
        margin: 0;
    }
    .login-body {
        padding: 2rem;
    }
    .login-icon {
        font-size: 2.5rem;
        color: #007bff;
        text-align: center;
        margin-bottom: 1rem;
    }
</style>
@endsection

@section('content')
<div class="container h-100 d-flex align-items-center justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card login-card">
            <div class="login-header">
                <h3><i class="fas fa-archive"></i> Sistem Pengarsipan</h3>
                <p>Masuk untuk mengelola arsip Anda</p>
            </div>

            <div class="card-body login-body">
                <div class="login-icon">
                    <i class="fas fa-user-circle"></i>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="email">{{ __('Alamat Email') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Masukkan email Anda">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="password">{{ __('Kata Sandi') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                               name="password" required autocomplete="current-password" placeholder="Masukkan kata sandi">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                   {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Ingat Saya') }}
                            </label>
                        </div>
                    </div>

                    <div class="form-group mb-0 text-center">
                        <button type="submit" class="btn btn-primary btn-block">
                            {{ __('Login') }}
                        </button>
                    </div>

                    <div class="text-center mt-3">
                        @if (Route::has('password.request'))
                            <a class="text-muted" href="{{ route('password.request') }}">
                                {{ __('Lupa Kata Sandi?') }}
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
