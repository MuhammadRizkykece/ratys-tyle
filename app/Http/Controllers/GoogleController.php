<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->user();

        $user = User::where('email', $googleUser->email)->first();

        $isNewUser = false;

        if (! $user) {
            $user = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'google_id' => $googleUser->id,
                'avatar' => $googleUser->avatar,
                'email_verified_at' => now(),
                'password' => bcrypt(uniqid()),
                'role' => 'customer',
            ]);

            $isNewUser = true;
        }

        Auth::login($user);

        return redirect()->route('home')
            ->with(
                'success',
                $isNewUser
                    ? 'Akun Google berhasil dibuat!'
                    : 'Login dengan Google berhasil!'
            );
    }
}
