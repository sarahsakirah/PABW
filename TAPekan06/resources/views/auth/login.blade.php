<x-guest-layout>
    <div class="auth-heading">
        <span class="auth-kicker">SELAMAT DATANG KEMBALI</span>
        <h2>Login ke akunmu</h2>
        <p>Masuk untuk melanjutkan ke dashboard laporan banjir.</p>
    </div>

    <x-auth-session-status class="auth-session-status" :status="session('status')" />

    <form class="auth-form" method="POST" action="{{ route('login') }}">
        @csrf

        <div class="auth-field">
            <x-input-label for="email" value="Alamat email" />
            <x-text-input id="email" class="auth-input block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="auth-field mt-5">
            <x-input-label for="password" value="Kata sandi" />

            <x-text-input id="password" class="auth-input block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" placeholder="Masukkan kata sandi" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="auth-options">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="auth-checkbox" name="remember">
                <span class="ms-2 text-sm text-gray-600">Ingat saya</span>
            </label>
        </div>

        <div class="auth-actions">
            @if (Route::has('password.request'))
                <a class="auth-link" href="{{ route('password.request') }}">
                    Lupa kata sandi?
                </a>
            @endif

            <x-primary-button class="auth-submit">
                Login
            </x-primary-button>
        </div>
    </form>
    <p class="auth-switch">Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a></p>
</x-guest-layout>
