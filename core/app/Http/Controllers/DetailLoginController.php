<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use App\Models\Category;

class DetailLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Auth::check()) {
                return redirect()->route('login'); // Replace 'login' with the actual route name for your login page
            }

            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $categories = DB::table('categories')->get();

        // Melakukan join antara tabel users dan permissions berdasarkan user_id
        $data = DB::table('detail_logins')
            ->select('detail_logins.*', 'users.name', 'detail_logins.updated_at as update_login')
            ->join('users', 'detail_logins.user_id', '=', 'users.id')
            ->where('detail_logins.user_id', '=', $user->id)
            ->orderBy('detail_logins.created_at', 'desc')
            ->get();

        // Melakukan join antara tabel users dan permissions berdasarkan user_id
        $all = DB::table('detail_logins')
            ->select('detail_logins.*', 'users.name', 'detail_logins.updated_at as update_login')
            ->join('users', 'detail_logins.user_id', '=', 'users.id')
            ->orderBy('detail_logins.created_at', 'desc')
            ->get();

        $position = $request->input('position', 'Permission');

        $header = view('partials.header', compact('categories', 'position'));
        $footer = view('partials.footer', compact('position'));

        return view('setting', compact('all', 'categories', 'data', 'user', 'header', 'footer', 'position'));
    }
}
