@extends('layout')
@section('title', 'Laporan Terkirim')
@section('content')
<section class="card" style="max-width:720px;margin:40px auto;text-align:center">
    <p style="font-size:48px;margin:0">✓</p>
    <h1>Laporan berhasil dikirim</h1>
    <p>Terima kasih telah menyampaikan informasi kondisi banjir kepada BPBD Kabupaten Bandung.</p>
    <p>Laporan dan foto bukti Anda sudah kami terima dengan status <strong>Menunggu</strong> dan akan ditindaklanjuti oleh petugas.</p>
    <div class="actions" style="justify-content:center;margin-top:24px">
        <a class="button" href="{{ route('lapor.create') }}">Kirim laporan lain</a>
    </div>
</section>
@endsection
