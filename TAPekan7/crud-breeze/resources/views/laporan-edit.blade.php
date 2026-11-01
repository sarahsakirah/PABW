@extends('layout')
@section('title', 'Ubah Laporan')
@section('content')<section class="card"><h1>Ubah laporan #{{ $laporan->id }}</h1><form method="POST" action="{{ route('petugas.laporan.update', $laporan) }}" enctype="multipart/form-data">@method('PUT')@include('laporan-form')<p class="actions"><button>Simpan Perubahan</button><a class="button secondary" href="{{ route('petugas.laporan.show', $laporan) }}">Batal</a></p></form></section>@endsection
