<x-guest-layout>
    <div class="auth-heading">
        <span class="auth-kicker">MULAI BERSAMA KAMI</span>
        <h2>Buat akun baru</h2>
        <p>Daftar untuk mengakses dashboard dan mengirim laporan banjir.</p>
    </div>

    <form class="auth-form" method="POST" action="{{ route('register') }}">
        @csrf

        <div class="auth-field">
            <x-input-label for="name" value="Nama lengkap" />
            <x-text-input id="name" class="auth-input block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Nama kamu" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="auth-field mt-4">
            <x-input-label for="email" value="Alamat email" />
            <x-text-input id="email" class="auth-input block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="auth-field mt-4">
            <x-input-label for="password" value="Kata sandi" />

            <x-text-input id="password" class="auth-input block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" placeholder="Minimal 8 karakter" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="auth-field mt-4">
            <x-input-label for="password_confirmation" value="Ulangi kata sandi" />

            <x-text-input id="password_confirmation" class="auth-input block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="auth-actions auth-register-actions">
            <a class="auth-link" href="{{ route('login') }}">
                Sudah punya akun? Login
            </a>

            <x-primary-button class="auth-submit">
                Daftar akun
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
