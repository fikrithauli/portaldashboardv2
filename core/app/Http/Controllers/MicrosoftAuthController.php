<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MicrosoftAuthController extends Controller
{
    public function handleCallback(Request $request)
    {
        $displayName = $request->input('displayName');
        $microsoftID = $request->input('id');
        $jobTitle = $request->input('jobTitle');
        $mail = $request->input('mail');

        // Cari pengguna berdasarkan microsoft_id
        $user = DB::table('users')->where('name', $displayName)->first();

        if ($user) {
            // Jika pengguna sudah terdaftar, perbarui updated_at dan job_title jika ada.
            $dataToUpdate = [
                'updated_at' => now(),
            ];

            DB::table('users')->where('id', $user->id)->update($dataToUpdate);
            Auth::loginUsingId($user->id); // Autentikasi pengguna yang sudah terdaftar.

            // Insert data ke tabel detail_logins
            $detailLoginData = [
                'user_id' => $user->id,
                'last_login_ip' => $request->ip(),
                'last_login_browser' => 'Chrome on Windows',
                'last_login_location' => 'Indonesia', // Ganti sesuai dengan lokasi
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
            DB::table('detail_logins')->insert($detailLoginData);
        } else {
            // Jika pengguna belum terdaftar, buat pengguna baru.
            $newUser = [
                'name' => $displayName,
                'email' => $mail,
                'microsoft_id' => $microsoftID,
                'job_title' => $jobTitle,
                'role_id'   => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $userId = DB::table('users')->insertGetId($newUser); // Masukkan pengguna baru dan ambil ID-nya.
            Auth::loginUsingId($userId); // Autentikasi pengguna baru.

            // Insert data ke tabel detail_logins untuk pengguna baru
            $detailLoginData = [
                'user_id' => $userId,
                'last_login_ip' => $request->ip(),
                'last_login_browser' => 'Chrome on Windows',
                'last_login_location' => 'Indonesia', // Ganti sesuai dengan lokasi
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
            DB::table('detail_logins')->insert($detailLoginData);
        }

        // Setelah berhasil masuk, arahkan ke halaman beranda dengan pesan selamat datang.
        return redirect('/home')->with('success', "Welcome, {$displayName}!");
    }
}
