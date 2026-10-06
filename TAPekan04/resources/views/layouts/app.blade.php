<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LaporBanjir') | BPBD Kabupaten Bandung</title>
    <style>
        :root { font-family: Arial, sans-serif; color: #12314a; background: #eef6fa; }
        * { box-sizing: border-box; }
        body { margin: 0; }
        header { background: #075985; color: white; padding: 20px max(5vw, calc((100vw - 1000px) / 2)); }
        header a { color: white; text-decoration: none; font-weight: bold; margin-right: 20px; }
        main { width: min(92%, 1000px); margin: 36px auto; }
        .button { display: inline-block; padding: 11px 16px; background: #0872aa; color: white; border: 0; border-radius: 8px; text-decoration: none; cursor: pointer; }
        .alert { padding: 15px 18px; border-radius: 10px; background: #dcfce7; color: #166534; margin-bottom: 20px; }
        .errors { background: #fee2e2; color: #991b1b; }
        .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 16px; }
        .card { background: white; border-radius: 14px; padding: 22px; box-shadow: 0 6px 20px #12314a12; }
        label { display: block; margin: 16px 0 6px; font-weight: bold; }
        input { width: 100%; padding: 11px; border: 1px solid #b8ccd8; border-radius: 7px; font-size: 16px; }
        .status { font-weight: bold; }
    </style>
</head>
<body>
    <header>
        <a href="{{ route('laporan.index') }}">LaporBanjir</a>
        <a href="{{ route('laporan.create') }}">Kirim laporan</a>
    </header>
    <main>
        @if ($errors->any())
            <div class="alert errors">{{ $errors->first() }}</div>
        @endif
        @yield('content')
    </main>
</body>
</html>
