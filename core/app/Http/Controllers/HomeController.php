<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

use App\Models\Dashboard;
use App\Models\Category;
use App\Models\User;

class HomeController extends Controller
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
        $categories = Category::all();
        $position = $request->input('position', 'Home');
        $footer = view('partials.footer', compact('position'));

        $filteredData = DB::table('dashboard')
            ->join('categories', 'dashboard.category_id', '=', 'categories.category_id')
            ->leftJoin('permissions', 'dashboard.dashboard_id', '=', 'permissions.dashboard_id')
            ->select('dashboard.*', 'categories.*')
            ->addSelect(DB::raw('(SELECT COUNT(*) FROM permissions WHERE permissions.dashboard_id = dashboard.dashboard_id AND permissions.permission_type = 1) AS dashboard_count'))
            ->orderByDesc('dashboard.created_at');

        $selectedCategoryIds = $request->input('category_id');

        if ($selectedCategoryIds && in_array('all', $selectedCategoryIds)) {
            // Do nothing, show all dashboards.
        } elseif ($selectedCategoryIds) {
            $filteredData->whereIn('dashboard.category_id', $selectedCategoryIds);
        }

        $filteredData = $filteredData->distinct()->get();

        // Add request_status to each dashboard in $filteredData
        foreach ($filteredData as $dashboard) {
            $dashboard->request_status = DB::table('permission_request')
                ->where('dashboard_id', $dashboard->dashboard_id)
                ->pluck('request_status')
                ->first();
        }

        $allowedDashboardIds = [];

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
            $allowedDashboardIds = $filteredData->pluck('dashboard_id')->toArray();
        }

        return view('home', compact('user', 'footer', 'filteredData', 'categories', 'position', 'allowedDashboardIds'));
    }

    // public function showDetail($dashboard_name)
    // {
    //     $dashboard_name = str_replace('-', ' ', $dashboard_name);

    //     $detailData = DB::table('dashboard')
    //         ->where('dashboard_name', $dashboard_name)
    //         ->first();

    //     // Jika tipe visualisasi adalah Tableau
    //     if ($detailData->visualization_type === 'Tableau') {
    //         // Ambil data tiket dari API
    //         $response = file_get_contents('http://10.2.114.197:8000/ticket');

    //         // Ubah data dari JSON ke PHP
    //         $ticket = json_decode($response, true);

    //         // Ambil nama tampilan dari database
    //         $viewName = $detailData->view_name;

    //         // Gabungkan URL dengan tiket dan nama tampilan
    //         $url = "https://tabfire.telkomsel.co.id/trusted/{$ticket}/views/{$viewName}";
    //     } else {
    //         // Jika bukan Tableau, gunakan embed_url
    //         $url = $detailData->embed_url;
    //     }

    //     // Kirim data ke tampilan
    //     return view('summarize', [
    //         'url' => $url,
    //         'detailData' => $detailData,
    //     ]);
    // }

    public function showDetail(Request $request, $dashboard_name)
    {
        $dashboard_name = str_replace('-', ' ', $dashboard_name);

        $detailData = DB::table('dashboard')
            ->where('dashboard_name', $dashboard_name)
            ->first();

        if (!$detailData) {
            abort(404, 'Dashboard tidak ditemukan.');
        }

        // Jika tipe visualisasi adalah Tableau
        if ($detailData->visualization_type === 'Tableau') {
            $response = file_get_contents('http://10.2.114.197:8000/ticket');
            $ticket = json_decode($response, true);

            $viewName = $detailData->view_name;
            $url = "https://tabfire.telkomsel.co.id/trusted/{$ticket}/views/{$viewName}";
        } else {
            $url = $detailData->embed_url;
        }

        // Ambil semua kategori
        $categories = Category::all();

        // Ambil posisi dari input request, default ke 'Permission'
        $position = $request->input('position', 'Permission');

        // Buat view partial header dan footer
        $header = view('partials.header', compact('categories', 'position'))->render();
        $footer = view('partials.footer', compact('position'))->render();

        // Kirim data ke tampilan
        return view('summarize', [
            'url' => $url,
            'detailData' => $detailData,
            'header' => $header,
            'footer' => $footer,
            'categories' => $categories,
        ]);
    }
}
