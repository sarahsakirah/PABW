@extends('layout')
@section('title', 'Tambah Laporan')
@section('content')<section class="card"><h1>Tambah laporan</h1><form method="POST" action="{{ route('petugas.laporan.store') }}" enctype="multipart/form-data">@include('laporan-form')<p class="actions"><button>Simpan</button><a class="button secondary" href="{{ route('petugas.laporan.index') }}">Batal</a></p></form></section>@endsection
