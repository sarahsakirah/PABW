@extends('layouts.app')
@section('title', $book->exists ? 'Ubah Buku' : 'Tambah Buku')
@section('content')
<div class="mb-4"><a href="{{ route('buku.index') }}" class="text-decoration-none small">&larr; Kembali ke katalog</a><h1 class="h3 mt-2">{{ $book->exists ? 'Ubah Buku' : 'Tambah Buku' }}</h1></div>
<div class="card border-0 shadow-sm"><div class="card-body p-4"><form method="POST" action="{{ $action }}">
    @csrf @if($method === 'PUT') @method('PUT') @endif
    @foreach(['judul' => 'Judul buku', 'penulis' => 'Penulis', 'penerbit' => 'Penerbit', 'tahun_terbit' => 'Tahun terbit', 'stok' => 'Stok'] as $field => $label)
        <div class="mb-3"><label class="form-label" for="{{ $field }}">{{ $label }}</label>
        <input class="form-control @error($field) is-invalid @enderror" id="{{ $field }}" name="{{ $field }}" type="{{ in_array($field, ['tahun_terbit', 'stok']) ? 'number' : 'text' }}" value="{{ old($field, $book->$field) }}" @if($field === 'tahun_terbit') min="1000" max="{{ date('Y') + 1 }}" @elseif($field === 'stok') min="0" @endif required>
        @error($field)<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
    @endforeach
    <button class="btn btn-primary">Simpan</button> <a class="btn btn-light" href="{{ route('buku.index') }}">Batal</a>
</form></div></div>
@endsection
