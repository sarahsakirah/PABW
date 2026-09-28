<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('assets/Logo Vector InkluSkill.png') }}">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mobile.css') }}">
    <title>@yield('title', 'InkluSkill | Belajar, Berlatih, Berdaya')</title>
</head>
<body>
    @hasSection('app')
        @yield('app')
    @else
        @yield('content')
    @endif
    @stack('scripts')
</body>
</html>
