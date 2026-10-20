@extends('layouts.banjir')

@section('title', 'Daftar Laporan')

@section('content')
    <h1>Daftar Laporan Banjir</h1>
    <p>Laporan kejadian banjir di Kabupaten Bandung.</p>
    <p><a class="button" href="{{ route('laporan.create') }}">Kirim laporan banjir</a></p>
    <div class="grid">
        @forelse ($laporan as $item)
            @include('partials.laporan-card', ['laporan' => $item])
        @empty
            <p>Belum ada laporan. Silakan kirim laporan pertama.</p>
        @endforelse
    </div>
@endsection
