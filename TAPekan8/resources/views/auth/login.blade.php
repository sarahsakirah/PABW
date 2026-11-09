@extends('layouts.guest')
@section('title', 'Masuk')
@section('content')
    <h5 class="mb-1">Masuk</h5>
    <p class="text-muted small mb-4">Gunakan email dan password akun Anda.</p>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    <form method="POST" action="{{ route('login.store') }}">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                class="form-control @error('email') is-invalid @enderror"
                placeholder="nama@email.com" required autofocus autocomplete="username">
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
                <input id="password" type="password" name="password"
                    class="form-control @error('password') is-invalid @enderror"
                    required autocomplete="current-password">
                <button type="button" class="btn btn-outline-secondary"
                    data-toggle-password="password" aria-label="Tampilkan password">
                    <i class="bi bi-eye"></i>
                </button>
                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="mb-4 form-check">
            <input id="remember" type="checkbox" class="form-check-input" name="remember">
            <label class="form-check-label" for="remember">Ingat saya</label>
        </div>
        <button type="submit" class="btn btn-primary w-100">Masuk</button>
    </form>
    <p class="text-center small text-muted mt-4 mb-0">
        Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
    </p>
@endsection
