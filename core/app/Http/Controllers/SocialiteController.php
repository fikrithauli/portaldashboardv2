<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

use App\Models\User;

class SocialiteController extends Controller
{
    public function redirectToMicrosoft()
    {
        return Socialite::driver('microsoft')->redirect();
    }

    public function handleMicrosoftCallback(Request $request)
    {
        $user = Socialite::driver('microsoft')->user();

        // Cek apakah email pengguna sudah ada di database
        $existingUser = User::where('email', $user->getEmail())->first();

        // Jika sudah ada, autentikasi pengguna
        if ($existingUser) {
            Auth::login($existingUser, true);
        } else {
            // Jika belum ada, buat akun baru
            $newUser = User::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                // Anda juga dapat menambahkan atribut lain sesuai kebutuhan aplikasi.
            ]);

            Auth::login($newUser, true);
        }

        return redirect()->intended('/');
    }
}
