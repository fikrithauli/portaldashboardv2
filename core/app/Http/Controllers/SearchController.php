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
        $userId = Auth::id();
        $allowedDashboardIds = [];

        $selectedCategoryIds = $request->input('category_id');

        $query = DB::table('dashboard')
            ->select('dashboard.*', 'permission_request.request_status', 'permission_request.user_id') // tambahkan 'permission_request.user_id' di sini
            ->leftJoin('permission_request', function ($join) use ($userId) {
                $join->on('dashboard.dashboard_id', '=', 'permission_request.dashboard_id')
                    ->where('permission_request.user_id', '=', $userId);
            });


        if ($selectedCategoryIds && in_array('all', $selectedCategoryIds)) {
            // Do nothing, show all dashboards.
        } elseif ($selectedCategoryIds) {
            $query->whereIn('dashboard.category_id', $selectedCategoryIds);
        }

        if (Auth::user()->role_id == 2) {
            $user_permissions = DB::table('permissions')
                ->where('user_id', $userId)
                ->pluck('dashboard_id')
                ->toArray();

            foreach ($user_permissions as $dashboard_ids) {
                $ids = explode(',', $dashboard_ids);
                $allowedDashboardIds = array_merge($allowedDashboardIds, $ids);
            }
        } else {
            $allowedDashboardIds = Dashboard::pluck('dashboard_id')->toArray();
        }

        $query->orderByDesc('dashboard.created_at');
        $query->groupBy('dashboard.dashboard_id');

        $filteredData = $query->get();

        $filteredData = $filteredData->map(function ($dashboard) use ($userId) {
            $permission = DB::table('permissions')
                ->where('dashboard_id', $dashboard->dashboard_id)
                ->where('permissions.user_id', $userId)
                ->first();

            $dashboard->permission_type = $permission ? $permission->permission_type : null;
            $dashboard->is_allowed = $dashboard->permission_type !== null && $dashboard->user_id == $userId;

            return $dashboard;
        });


        return response()->json($filteredData);
    }
}
