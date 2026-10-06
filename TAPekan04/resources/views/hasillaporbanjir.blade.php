@extends('layouts.app')

@section('title', 'Konfirmasi Laporan')

@section('content')
    <x-alert>Laporan banjir berhasil disimpan.</x-alert>
    <h1>Data Laporan Banjir</h1>
    <div class="grid">
        @include('partials.laporan-card', ['laporan' => $laporan])
    </div>
    <p style="margin-top:24px"><a class="button" href="{{ route('laporan.index') }}">Lihat semua laporan</a></p>
@endsection
