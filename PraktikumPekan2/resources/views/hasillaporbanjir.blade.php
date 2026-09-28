<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaporBanjir | Konfirmasi Laporan</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; display: grid; place-items: center; font-family: Arial, sans-serif; background: #eaf7ff; color: #062d52; }
        .card { width: min(92%, 700px); margin: 30px auto; padding: 40px; background: #fff; border-radius: 18px; box-shadow: 0 12px 30px rgba(21, 94, 117, .16); }
        h2 { margin: 0 0 24px; color: #0872aa; font-size: 32px; }
        .data { padding: 8px 20px; border: 1px solid #a9ddf8; border-radius: 10px; color: #385d7b; font-size: 18px; line-height: 1.6; }
        a { display: block; margin-top: 30px; padding: 15px; border-radius: 9px; background: #0872aa; color: #fff; text-align: center; text-decoration: none; font-weight: bold; font-size: 18px; }
        a:hover { background: #05618f; }
        @media (max-width: 520px) { .card { padding: 25px; } h2 { font-size: 28px; } }
    </style>
</head>
<body>
    <main class="card">
        <h2>Data Laporan Banjir</h2>
        <section class="data">
            <p><strong>Nama Pelapor:</strong> {{ $nama_pelapor }}</p>
            <p><strong>Lokasi Kejadian:</strong> {{ $lokasi }}</p>
            <p><strong>Tinggi Genangan Air:</strong> {{ $tinggi_genangan }} cm</p>
        </section>
        <a href="/formlaporbanjir">Buat Laporan Baru</a>
    </main>
</body>
</html>
