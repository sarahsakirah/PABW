<?php

namespace App\Http\Controllers\Auth;



use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RegisterController extends Controller
{
    /**
     * Show the registration form.
     */
    public function create(): View
    {
        return view('auth.register');
    }
    /**
     * Register a new user. Self-registered accounts always get the
"user" role.
     */
    public function store(RegisterRequest $request): RedirectResponse
    {
        $user = User::create([
            ...$request->safe()->only(['name', 'email', 'password']),
            'role' => UserRole::User,
        ]);
        return redirect()->route('login')->with(
            'success',
            'Registrasi berhasil. Silakan masuk dengan akun Anda.'
        );
    }
}
