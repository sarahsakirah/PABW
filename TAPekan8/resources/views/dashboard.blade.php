@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="mb-4">
    <h4 class="mb-1">Halo, {{ auth()->user()->name }}</h4>
    <p class="text-muted mb-0">Anda login sebagai <strong>{{
auth()->user()->role->label() }}</strong>. Pilih menu di bawah untuk
        mulai bekerja.</p>
</div>
<div class="row g-3">
    <div class="col-md-6 col-lg-4"><div class="card h-100 border-0 shadow-sm"><div class="card-body">
        <div class="text-muted small">Koleksi buku</div><div class="fs-2 fw-semibold">{{ $totalBooks }}</div>
        <a href="{{ route('buku.index') }}" class="small text-decoration-none">Lihat katalog <i class="bi bi-arrow-right"></i></a>
    </div></div></div>
    <div class="col-md-6 col-lg-4"><div class="card h-100 border-0 shadow-sm"><div class="card-body">
        <div class="text-muted small">Data peminjaman</div><div class="fs-2 fw-semibold">{{ $totalPeminjaman }}</div>
        <a href="{{ route('peminjaman.index') }}" class="small text-decoration-none">Kelola peminjaman <i class="bi bi-arrow-right"></i></a>
    </div></div></div>
    @if (auth()->user()->isAdmin())
        <div class="col-md-6 col-lg-4"><div class="card h-100 border-0 shadow-sm"><div class="card-body">
            <div class="text-muted small">Akun pengguna</div><div class="fs-2 fw-semibold">{{ $totalUsers }}</div>
            <a href="{{ route('admin.users.index') }}" class="small text-decoration-none">Kelola pengguna <i class="bi bi-arrow-right"></i></a>
        </div></div></div>
    @endif
</div>
@endsection
