<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use App\Models\Dashboard;
use App\Models\Category;
use App\Models\User;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Auth::check()) {
                return redirect()->route('login')->with('error', 'Session expired, please login again.');
            }

            return $next($request);
        });
    }

    public function show(Request $request)
    {
        // ambil user id dari session login
        $userId = Auth::id();

        // ambil data user dari table 'users' pakai query builder
        $user = DB::table('users')->where('id', $userId)->first();

        // ambil data kategori
        $categories = Category::all();

        $dashboards = DB::table('dashboard')
            ->orderBy('created_at', 'desc')
            ->groupBy('dashboard_id')
            ->get();

        // dapatkan posisi dari request default ke permissions
        $position = $request->input('position', 'Permission');

        // buat view partial
        $header = view('partials.header', compact('categories', 'position'));
        $footer = view('partials.footer', compact('position'));

        // return view
        return view('profile-setting', compact('user', 'header', 'footer', 'categories', 'position'));
    }

    public function profileUpdate(Request $request, $id)
    {
        // Ambil data user lama
        $oldUser = DB::table('users')->where('id', $id)->first();

        // Path gambar default (jika tidak upload)
        $avatarPath = $oldUser->avatar;

        // Validasi input file avatar
        if ($request->hasFile('avatar')) {
            // Validasi hanya menerima file .jpg dan .png
            $request->validate([
                'avatar' => 'mimes:jpg,jpeg,png|max:2048', // Maksimal ukuran 2MB
            ]);

            // Ambil file yang diupload
            $avatar = $request->file('avatar');
            $avatarName = time() . '_' . $avatar->getClientOriginalName();

            // Pindahkan file ke folder uploads/avatar
            $avatar->move('core/uploads/avatar', $avatarName);  // Tanpa public_path
            $avatarPath = $avatarName;

            // Hapus avatar lama jika ada
            if ($oldUser && $oldUser->avatar) {
                $oldAvatarPath = 'core/uploads/avatar/' . $oldUser->avatar;
                if (file_exists($oldAvatarPath)) {
                    unlink($oldAvatarPath);
                }
            }
        }

        // Update user (name dan avatar saja)
        DB::table('users')->where('id', $id)->update([
            'name' => $request->input('name'),
            'avatar' => $avatarPath,
        ]);

        return redirect()->route('profile-settings')->with('success', 'Profil berhasil diperbarui.');
    }

    public function resetAvatar(Request $request, $id)
    {
        // Ambil data user berdasarkan ID
        $user = DB::table('users')->where('id', $id)->first();

        if (!$user || !$user->avatar) {
            return response()->json(['success' => false, 'message' => 'Avatar tidak ditemukan.']);
        }

        // Hapus avatar lama jika ada
        $oldAvatarPath = 'core/uploads/avatar/' . $user->avatar;
        if (file_exists($oldAvatarPath)) {
            unlink($oldAvatarPath);  // Menghapus file avatar dari server
        }

        // Update database untuk menghapus avatar
        DB::table('users')->where('id', $id)->update([
            'avatar' => null,
        ]);

        // Mengembalikan respon sukses
        return response()->json(['success' => true]);
    }

    public function updatePassword(Request $request)
    {
        // Validasi input form dengan pesan kustom
        $validated = $request->validate([
            'new-password' => 'required|min:8|confirmed', // Validasi untuk password baru
        ], [
            'new-password.required' => 'Kata sandi baru wajib diisi.',
            'new-password.min' => 'Kata sandi baru harus memiliki minimal 8 karakter.',
            'new-password.confirmed' => 'Konfirmasi kata sandi baru tidak cocok.', // Pesan kustom untuk konfirmasi kata sandi
        ]);

        // Ambil user yang sedang login
        $user = Auth::user();

        // Hash password menggunakan MD5
        $hashedPassword = md5($request->input('new-password'));

        // Perbarui password
        $user->password = $hashedPassword;
        $user->save();

        // Redirect dengan pesan sukses
        return redirect()->route('profile-settings')->with('success', 'Kata sandi berhasil diperbarui.');
    }
}
