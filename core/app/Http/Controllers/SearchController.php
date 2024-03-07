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

    // public function filterByCategory(Request $request)
    // {
    //     $selectedCategoryIds = $request->input('category_id');

    //     // Pastikan nama tabel dan kolom yang digunakan sesuai dengan struktur database Anda.
    //     $query = DB::table('dashboard');

    //     // Jika 'All Categories' dipilih, tidak perlu menambahkan kriteria filter untuk kolom kategori.
    //     if ($selectedCategoryIds && in_array('all', $selectedCategoryIds)) {
    //         // Do nothing, show all dashboards.
    //     } elseif ($selectedCategoryIds) {
    //         $query->whereIn('category_id', $selectedCategoryIds);
    //     }

    //     // Inisialisasi array untuk menyimpan ID dashboard yang diizinkan
    //     $allowedDashboardIds = [];

    //     $user = Auth::user();
    //     if ($user->role_id == 2) {
    //         // Jika user memiliki role_id 2, ambil data permissions berdasarkan user_id
    //         $user_permissions = DB::table('permissions')
    //             ->where('user_id', $user->id)
    //             ->pluck('dashboard_id')
    //             ->toArray();

    //         // Ubah data permissions menjadi array dan tambahkan ke dalam array allowedDashboardIds
    //         foreach ($user_permissions as $dashboard_ids) {
    //             $ids = explode(',', $dashboard_ids);
    //             $allowedDashboardIds = array_merge($allowedDashboardIds, $ids);
    //         }
    //     } else {
    //         // Jika user memiliki role_id 1, izinkan semua dashboard
    //         $allowedDashboardIds = Dashboard::pluck('dashboard_id')->toArray();
    //     }

    //     // Urutkan data berdasarkan 'created_at' secara descending (desc).
    //     $query->orderByDesc('created_at');

    //     // Ambil data yang difilter dari database
    //     $filteredData = $query->get();

    //     // Tambahkan properti 'is_allowed' ke dalam data
    //     $filteredData = $filteredData->map(function ($dashboard) use ($allowedDashboardIds) {
    //         $dashboard->is_allowed = in_array($dashboard->dashboard_id, $allowedDashboardIds);
    //         return $dashboard;
    //     });

    //     // Kembalikan data dalam format JSON
    //     return response()->json($filteredData);
    // }

    // public function filterByCategory(Request $request)
    // {
    //     $selectedCategoryIds = $request->input('category_id');

    //     // Ensure that the table and columns used match your database structure.
    //     $query = DB::table('dashboard');

    //     // If 'All Categories' is selected, no need to add a filter for the category column.
    //     if ($selectedCategoryIds && in_array('all', $selectedCategoryIds)) {
    //         // Do nothing, show all dashboards.
    //     } elseif ($selectedCategoryIds) {
    //         $query->whereIn('category_id', $selectedCategoryIds);
    //     }

    //     // Initialize an array to store allowed dashboard IDs
    //     $allowedDashboardIds = [];

    //     $user = Auth::user();
    //     if ($user->role_id == 2) {
    //         // If the user has role_id 2, fetch permissions based on user_id
    //         $user_permissions = DB::table('permissions')
    //             ->where('user_id', $user->id)
    //             ->pluck('dashboard_id')
    //             ->toArray();

    //         // Convert permissions data to an array and add it to the allowedDashboardIds array
    //         foreach ($user_permissions as $dashboard_ids) {
    //             $ids = explode(',', $dashboard_ids);
    //             $allowedDashboardIds = array_merge($allowedDashboardIds, $ids);
    //         }
    //     } else {
    //         // If the user has role_id 1, allow all dashboards
    //         $allowedDashboardIds = Dashboard::pluck('dashboard_id')->toArray();
    //     }

    //     // Order data by 'created_at' in descending order
    //     $query->orderByDesc('created_at');

    //     // Eager load request_status using a left join
    //     $query->leftJoin('permission_request', function ($join) {
    //         $join->on('dashboard.dashboard_id', '=', 'permission_request.dashboard_id');
    //     })->select('dashboard.*', 'permission_request.request_status');

    //     // Filter data from the database
    //     $filteredData = $query->get();

    //     // Add 'is_allowed' property to each dashboard in $filteredData
    //     $filteredData = $filteredData->map(function ($dashboard) use ($allowedDashboardIds) {
    //         $dashboard->is_allowed = in_array($dashboard->dashboard_id, $allowedDashboardIds);
    //         return $dashboard;
    //     });

    //     // Return data in JSON format
    //     return response()->json($filteredData);
    // }

    public function filterByCategory(Request $request)
    {
        $allowedDashboardIds = [];

        $selectedCategoryIds = $request->input('category_id');

        $query = DB::table('dashboard');

        if ($selectedCategoryIds && in_array('all', $selectedCategoryIds)) {
            // Do nothing, show all dashboards.
        } elseif ($selectedCategoryIds) {
            $query->whereIn('category_id', $selectedCategoryIds);
        }

        $user = Auth::user();
        if ($user->role_id == 2) {
            $user_permissions = DB::table('permissions')
                ->where('user_id', $user->id)
                ->pluck('dashboard_id')
                ->toArray();

            foreach ($user_permissions as $dashboard_ids) {
                $ids = explode(',', $dashboard_ids);
                $allowedDashboardIds = array_merge($allowedDashboardIds, $ids);
            }
        } else {
            $allowedDashboardIds = Dashboard::pluck('dashboard_id')->toArray();
        }

        $query->orderByDesc('created_at');
        $query->leftJoin('permission_request', function ($join) {
            $join->on('dashboard.dashboard_id', '=', 'permission_request.dashboard_id');
        })->select('dashboard.*', 'permission_request.request_status');

        $filteredData = $query->get();

        $filteredData = $filteredData->map(function ($dashboard) use ($allowedDashboardIds) {
            $permission = DB::table('permissions')->where('dashboard_id', $dashboard->dashboard_id)->first();
            $dashboard->permission_type = $permission ? $permission->permission_type : null;
            $dashboard->is_allowed = in_array($dashboard->dashboard_id, $allowedDashboardIds);
            return $dashboard;
        });

        return response()->json($filteredData);
    }
}
