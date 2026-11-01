@extends('layout')
@section('title', 'Kirim Laporan')
@section('content')
<section class="card"><p class="muted">BADAN PENANGGULANGAN BENCANA DAERAH KABUPATEN BANDUNG</p><h1>Laporkan kondisi banjir</h1><p>Isi informasi lokasi dan sertakan foto terbaru agar petugas dapat menindaklanjuti laporan.</p>
<form method="POST" action="{{ route('lapor.store') }}" enctype="multipart/form-data">@csrf
<div class="row"><div><label>Nama pelapor</label><input name="nama_pelapor" value="{{ old('nama_pelapor') }}" required>@error('nama_pelapor')<p class="error">{{ $message }}</p>@enderror</div><div><label>Nomor HP</label><input name="no_hp" value="{{ old('no_hp') }}" required>@error('no_hp')<p class="error">{{ $message }}</p>@enderror</div></div>
<div class="row"><div><label>Lokasi kejadian</label><input name="lokasi" value="{{ old('lokasi') }}" placeholder="Alamat atau patokan lokasi" required>@error('lokasi')<p class="error">{{ $message }}</p>@enderror</div><div><label>Kecamatan</label><input name="kecamatan" value="{{ old('kecamatan') }}" required>@error('kecamatan')<p class="error">{{ $message }}</p>@enderror</div></div>
<div class="row"><div><label>Perkiraan tinggi air (cm)</label><input type="number" min="0" max="1000" name="tinggi_air" value="{{ old('tinggi_air') }}" required>@error('tinggi_air')<p class="error">{{ $message }}</p>@enderror</div><div><label>Tanggal kejadian (opsional)</label><input type="date" name="tanggal_kejadian" value="{{ old('tanggal_kejadian') }}" max="{{ now()->toDateString() }}">@error('tanggal_kejadian')<p class="error">{{ $message }}</p>@enderror</div></div>
<label>Keterangan</label><textarea name="keterangan" placeholder="Kondisi warga, akses jalan, dan informasi lain">{{ old('keterangan') }}</textarea>@error('keterangan')<p class="error">{{ $message }}</p>@enderror
<label>Foto kondisi banjir (JPG/PNG, maksimal 2 MB)</label><input type="file" name="foto" accept="image/jpeg,image/png" required>@error('foto')<p class="error">{{ $message }}</p>@enderror<p class="muted">Pastikan foto menunjukkan kondisi lokasi yang dilaporkan.</p><button type="submit">Kirim Laporan</button>
</form></section>
@endsection
