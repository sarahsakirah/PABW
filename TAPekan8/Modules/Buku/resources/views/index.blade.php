@extends('layouts.app')
@section('title', 'Katalog Buku')
@section('content')
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
    <div><h1 class="h3 mb-1">Katalog Buku</h1><p class="text-muted mb-0">Cari dan lihat koleksi buku perpustakaan.</p></div>
    @if(auth()->user()->isAdmin())<a class="btn btn-primary" href="{{ route('buku.create') }}"><i class="bi bi-plus-lg me-1"></i>Tambah buku</a>@endif
</div>
@if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
<div class="card border-0 shadow-sm">
    <div class="card-body border-bottom"><form method="GET" action="{{ route('buku.index') }}" class="row g-2">
        <div class="col-sm-9 col-lg-10"><input class="form-control" type="search" name="search" value="{{ $search }}" placeholder="Cari judul, penulis, atau penerbit"></div>
        <div class="col-sm-3 col-lg-2 d-grid"><button class="btn btn-outline-primary">Cari</button></div>
    </form></div>
    <div class="table-responsive"><table class="table table-hover align-middle mb-0">
        <thead class="table-light"><tr><th>Judul</th><th>Penulis</th><th>Penerbit</th><th>Tahun</th><th>Stok</th>@if(auth()->user()->isAdmin())<th class="text-end">Aksi</th>@endif</tr></thead>
        <tbody>
        @forelse($books as $book)<tr><td class="fw-semibold">{{ $book->judul }}</td><td>{{ $book->penulis }}</td><td>{{ $book->penerbit }}</td><td>{{ $book->tahun_terbit }}</td><td>{{ $book->stok }}</td>
            @if(auth()->user()->isAdmin())<td class="text-end text-nowrap"><a class="btn btn-sm btn-outline-primary" href="{{ route('buku.edit', $book) }}">Ubah</a>
                <form class="d-inline" method="POST" action="{{ route('buku.destroy', $book) }}" onsubmit="return confirm('Hapus buku ini?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger">Hapus</button></form></td>@endif
        </tr>@empty<tr><td colspan="{{ auth()->user()->isAdmin() ? 6 : 5 }}" class="text-center text-muted py-5">Belum ada buku yang cocok.</td></tr>@endforelse
        </tbody></table></div>
    @if($books->hasPages())<div class="card-footer bg-white">{{ $books->links() }}</div>@endif
</div>
@endsection
