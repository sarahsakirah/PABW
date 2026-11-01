<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title', 'LaporBanjir') · BPBD Kabupaten Bandung</title>
<style>
:root{font-family:Arial,sans-serif;color:#172b3a;background:#f2f7f9}*{box-sizing:border-box}body{margin:0}header{background:#073b58;color:white;padding:16px max(22px,calc((100% - 1080px)/2));display:flex;align-items:center;justify-content:space-between;gap:16px}header a{color:white;text-decoration:none;margin-right:14px}.brand{font-weight:700;font-size:20px}main{max-width:1080px;margin:34px auto;padding:0 20px}.card{background:white;border:1px solid #dce7eb;border-radius:14px;padding:24px;margin:16px 0;box-shadow:0 8px 24px #17394a0c}h1{margin-top:0;color:#073b58}label{font-weight:600;display:block;margin:16px 0 6px}input,textarea,select{width:100%;padding:11px;border:1px solid #b8c9d1;border-radius:8px;font:inherit}textarea{min-height:100px;resize:vertical}button,.button{display:inline-block;background:#087f8c;color:white;border:0;border-radius:8px;padding:10px 16px;text-decoration:none;font:inherit;font-weight:700;cursor:pointer}.button.secondary{background:#e5eef1;color:#17394a}.button.danger,button.danger{background:#b42318}.error{color:#b42318;font-size:14px;margin:5px 0}.success{padding:12px;background:#e8f7ee;border:1px solid #b7e4c7;color:#17643b;border-radius:8px}.muted{color:#607784}.row{display:grid;grid-template-columns:1fr 1fr;gap:16px}.actions{display:flex;gap:8px;align-items:center;flex-wrap:wrap}table{width:100%;border-collapse:collapse}th,td{text-align:left;padding:11px 8px;border-bottom:1px solid #e1e9ec;vertical-align:middle}img.thumb{width:82px;height:64px;object-fit:cover;border-radius:7px}nav{display:flex;align-items:center;gap:10px}nav form{display:inline}nav button{background:transparent;padding:5px 8px}footer{text-align:center;color:#607784;padding:26px}@media(max-width:650px){.row{grid-template-columns:1fr}header{align-items:flex-start;flex-direction:column}table{font-size:13px}main{margin-top:20px}.card{padding:18px}}
</style>
</head>
<body>
<header><a class="brand" href="{{ route('lapor.create') }}">🌧 LaporBanjir</a><nav><a href="{{ route('lapor.create') }}">Kirim Laporan</a>@auth<a href="{{ route('petugas.laporan.index') }}">Kelola Laporan</a><form method="POST" action="{{ route('logout') }}">@csrf<button type="submit">Keluar</button></form>@else<a href="{{ route('login') }}">Login Petugas</a>@endauth</nav></header>
<main>@if(session('success'))<div class="success">{{ session('success') }}</div>@endif @yield('content')</main>
<footer>BPBD Kabupaten Bandung · Layanan LaporBanjir</footer>
</body>
</html>
