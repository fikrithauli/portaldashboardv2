<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use App\Models\Dashboard;
use App\Models\Category;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        // Mendapatkan nilai dari input pencarian
        $keyword = $request->input('keyword');

        // Lakukan proses pencarian menggunakan Query Builder
        $searchResults = DB::table('dashboard')
            ->where('dashboard_name', 'like', '%' . $keyword . '%')
            ->get();

        $user = Auth::user();
        $allowedDashboardIds = [];
        if ($user->role_id == 2) {
            // Jika user memiliki role_id 2, ambil data permissions berdasarkan user_id
            $user_permissions = DB::table('permissions')
                ->where('user_id', $user->id)
                ->pluck('dashboard_id')
                ->toArray();

            // Ubah data permissions menjadi array dan tambahkan ke dalam array allowedDashboardIds
            foreach ($user_permissions as $dashboard_ids) {
                $ids = explode(',', $dashboard_ids);
                $allowedDashboardIds = array_merge($allowedDashboardIds, $ids);
            }
        } else {
            // Jika user memiliki role_id 1, izinkan semua dashboard
            $allowedDashboardIds = Dashboard::pluck('dashboard_id')->toArray();
        }

        // Panggil view header dan footer
        $position = $request->input('position', 'Search');
        $header = view('partials.header', compact('categories', 'position'));
        $footer = view('partials.footer', compact('position'));

        // Kirim hasil pencarian dan data permission ke tampilan
        return view('search_results')
            ->with('results', $searchResults)
            ->with('header', $header)
            ->with('footer', $footer)
            ->with('allowedDashboardIds', $allowedDashboardIds)
            ->with('user', $user)
            ->with('categories', $categories);
    }

    public function filterByCategory(Request $request)
    {
        $selectedCategoryIds = $request->input('category_id');

        // Pastikan nama tabel dan kolom yang digunakan sesuai dengan struktur database Anda.
        $query = DB::table('dashboard');

        // Jika 'All Categories' dipilih, tidak perlu menambahkan kriteria filter untuk kolom kategori.
        if ($selectedCategoryIds && in_array('all', $selectedCategoryIds)) {
            // Do nothing, show all dashboards.
        } elseif ($selectedCategoryIds) {
            $query->whereIn('category_id', $selectedCategoryIds);
        }

        // Inisialisasi array untuk menyimpan ID dashboard yang diizinkan
        $allowedDashboardIds = [];

        $user = Auth::user();
        if ($user->role_id == 2) {
            // Jika user memiliki role_id 2, ambil data permissions berdasarkan user_id
            $user_permissions = DB::table('permissions')
                ->where('user_id', $user->id)
                ->pluck('dashboard_id')
                ->toArray();

            // Ubah data permissions menjadi array dan tambahkan ke dalam array allowedDashboardIds
            foreach ($user_permissions as $dashboard_ids) {
                $ids = explode(',', $dashboard_ids);
                $allowedDashboardIds = array_merge($allowedDashboardIds, $ids);
            }
        } else {
            // Jika user memiliki role_id 1, izinkan semua dashboard
            $allowedDashboardIds = Dashboard::pluck('dashboard_id')->toArray();
        }

        // Urutkan data berdasarkan 'created_at' secara descending (desc).
        $query->orderByDesc('created_at');

        // Ambil data yang difilter dari database
        $filteredData = $query->get();

        // Tambahkan properti 'is_allowed' ke dalam data
        $filteredData = $filteredData->map(function ($dashboard) use ($allowedDashboardIds) {
            $dashboard->is_allowed = in_array($dashboard->dashboard_id, $allowedDashboardIds);
            return $dashboard;
        });

        // Kembalikan data dalam format JSON
        return response()->json($filteredData);
    }
}
