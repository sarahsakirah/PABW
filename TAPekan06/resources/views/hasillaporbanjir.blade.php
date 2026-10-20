@extends('layouts.banjir')

@section('title', 'Konfirmasi Laporan')

@section('content')
    <div class="alert" role="status">Laporan banjir berhasil disimpan.</div>
    <h1>Data Laporan Banjir</h1>
    <div class="grid">
        @include('partials.laporan-card', ['laporan' => $laporan])
    </div>
    <p style="margin-top:24px"><a class="button" href="{{ route('laporan.index') }}">Lihat semua laporan</a></p>
@endsection
