<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaporBanjir | Form Pelaporan</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; font-family: Arial, sans-serif; background: #eaf7ff; color: #062d52; }
        .container { width: min(92%, 700px); margin: 54px auto; background: #fff; border-radius: 18px; overflow: hidden; box-shadow: 0 12px 30px rgba(21, 94, 117, .16); }
        header { padding: 30px 40px; background: #0872aa; color: #fff; }
        header h1 { margin: 0 0 10px; font-size: 32px; }
        header p { margin: 0; font-weight: bold; }
        form { padding: 36px 40px 32px; }
        label { display: block; margin: 18px 0 8px; font-size: 18px; font-weight: bold; }
        input { width: 100%; padding: 13px; border: 1px solid #a9ddf8; border-radius: 9px; font: 18px Arial, sans-serif; }
        input:focus { outline: 2px solid #16a1df; border-color: #16a1df; }
        button { width: 100%; margin-top: 27px; padding: 14px; border: 0; border-radius: 9px; background: #078dca; color: #fff; cursor: pointer; font: bold 18px Arial, sans-serif; }
        button:hover { background: #0872aa; }
        .note { margin: 21px 0 3px; color: #49677e; text-align: center; font-size: 14px; }
        @media (max-width: 520px) { .container { margin: 25px auto; } header, form { padding-left: 24px; padding-right: 24px; } }
    </style>
</head>
<body>
    <main class="container">
        <header>
            <h1>LaporBanjir</h1>
            <p>Form pelaporan banjir BPBD Kabupaten Bandung</p>
        </header>
        <form action="/proseslaporbanjir" method="POST">
            @csrf
            <label for="nama_pelapor">Nama Pelapor</label>
            <input id="nama_pelapor" type="text" name="nama_pelapor" required>
            <label for="lokasi">Lokasi Kejadian</label>
            <input id="lokasi" type="text" name="lokasi" required>
            <label for="tinggi_genangan">Tinggi Genangan Air (cm)</label>
            <input id="tinggi_genangan" type="number" name="tinggi_genangan" min="0" required>
            <button type="submit">Kirim Laporan</button>
        </form>
    </main>
</body>
</html>
