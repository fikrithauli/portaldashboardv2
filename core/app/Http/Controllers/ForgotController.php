<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\DB;

use App\Models\User;

class ForgotController extends Controller
{

    public function showForgotPasswordForm()
    {
        return view('forgot_password', ['email' => null]); // Tambahkan default email = null
    }


    public function checkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = DB::table('users')->where('email', $request->email)->first();

        if (!$user) {
            return redirect()->route('forgot.password.form')->with('error', 'Email tidak ditemukan.');
        }

        return view('forgot_password', ['email' => $request->email]);
    }



    // Memproses reset password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        // Update password menggunakan MD5 dengan Query Builder
        DB::table('users')->where('email', $request->email)->update([
            'password' => md5($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Your password has been successfully reset.');
    }
}
