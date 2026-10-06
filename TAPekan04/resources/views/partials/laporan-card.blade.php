@php
    $status = $laporan->tinggi_genangan < 50 ? 'Waspada' : ($laporan->tinggi_genangan < 100 ? 'Siaga' : 'Awas');
    $warna = ['Waspada' => '#15803d', 'Siaga' => '#b45309', 'Awas' => '#b91c1c'][$status];
@endphp
<article class="card">
    <p><strong>{{ $laporan->nama_pelapor }}</strong></p>
    <p>Lokasi: {{ $laporan->lokasi }}</p>
    <p>Tinggi genangan: {{ $laporan->tinggi_genangan }} cm</p>
    <p>Tanggal kejadian: {{ $laporan->tanggal_kejadian->format('d-m-Y') }}</p>
    <p class="status" style="color: {{ $warna }}">Status: {{ $status }}</p>
</article>
