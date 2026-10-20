<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <main class="auth-page">
            <div class="auth-shell">
                <section class="auth-intro">
                    <a class="auth-brand" href="{{ route('home') }}"><span class="auth-brand-mark">≈</span> LaporBanjir</a>
                    <div class="auth-intro-copy">
                        <span class="auth-eyebrow">BPBD KABUPATEN BANDUNG</span>
                        <h1>Informasi banjir, lebih cepat dan mudah.</h1>
                        <p>Masuk untuk melihat laporan warga dan membantu memantau kondisi genangan di sekitar Anda.</p>
                    </div>
                    <div class="auth-intro-note"><span class="auth-live-dot"></span> Portal pelaporan dan pemantauan banjir</div>
                    <div class="auth-wave" aria-hidden="true">〰</div>
                </section>

                <section class="auth-panel">
                    <a class="auth-mobile-brand" href="{{ route('home') }}"><span class="auth-brand-mark">≈</span> LaporBanjir</a>
                {{ $slot }}
                </section>
            </div>
        </main>
    </body>
</html>
