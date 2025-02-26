<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\DB;

use App\Models\User;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['showLoginForm', 'login', 'logout']]);
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = md5($request->input('password'));

        $user = User::where('email', $email)->where('password', $password)->first();

        if ($user) {
            Auth::login($user);

            // Insert detail login baru menggunakan Query Builder
            DB::table('detail_logins')->insert([
                'user_id' => $user->id,
                'last_login_browser' => 'Chrome on Windows',
                'last_login_ip' => $request->ip(),
                'last_login_location' => 'Indonesia', // Hardcode lokasi
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $greeting = "Welcome, {$user->name}!";

            return redirect()->route('home')->with('success', "$greeting");
        }

        return redirect()->route('login')->with('error', 'Incorrect email or password')->withInput();
    }


    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name'              => 'required',
            'email'             => 'required|email|unique:users',
            'password'          => 'required|min:3',
            'confirm_password'  => 'required|same:password',
        ], [
            'confirm_password.required' => 'The confirmation password field is required.',
            'confirm_password.same'     => 'The confirmation password must match the password field.',
        ]);

        $user = User::create([
            'name'      => $request->input('name'),
            'email'     => $request->input('email'),
            'password'  => md5($request->input('password')),
            'role_id'   => 2,
        ]);

        Auth::login($user);

        Session::flash('success', 'Registrasi berhasil! Akun Anda telah terdaftar.');

        return redirect()->route('login');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

        // Cek apakah pengguna sudah terdaftar berdasarkan email
        $existingUser = User::where('email', $user->getEmail())->first();

        if ($existingUser) {
            // Jika pengguna sudah terdaftar, lakukan proses login
            Auth::login($existingUser);
        } else {
            // Jika pengguna belum terdaftar, buat entri baru di tabel users
            $newUser            = new User();
            $newUser->name      = $user->getName();
            $newUser->email     = $user->getEmail();
            $newUser->google_id = $user->getId(); // Simpan ID unik pengguna Google
            $newUser->password  = md5('123'); // Setel password default sebagai MD5 dari "123"
            $newUser->role_id   = 2; // Setel role default sebagai '2'

            // Ambil URL foto profil dari Google
            $avatarUrl = $user->getAvatar();
            // Simpan URL foto profil ke dalam kolom 'avatar' di tabel users
            $newUser->avatar = $avatarUrl;


            $newUser->save();

            Auth::login($newUser);
        }

        Session::flash('success', 'Registrasi berhasil! Akun Anda telah terdaftar.');
        return redirect()->route('home');
    }

    public function logout()
    {
        Auth::logout();

        // Hancurkan sesi
        session()->invalidate();
        session()->flush();

        // Tambahkan header no-cache
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Pragma: no-cache');
        header('Expires: 0');

        return redirect()->route('login');
    }
}
