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


    public function showDetail($dashboard_name)
    {
        $dashboard_name = str_replace('-', ' ', $dashboard_name);

        $detailData = DB::table('dashboard')
            ->where('dashboard_name', $dashboard_name)
            ->first();

        // Check if the visualization_type is tableau
        if ($detailData->visualization_type === 'Tableau') {
            // Get the ticket from the API
            $response = Http::get('http://10.2.114.197:8000/ticket');
            $ticket = $response->json();
            dd($ticket);

            // Get the view_name from the detailData
            $viewName = $detailData->view_name;

            // Combine embed_url, 'trusted', ticket, and view_name to form the final URL
            $url = "https://tabfire.telkomsel.co.id/trusted/{$ticket}/views/{$viewName}";
        } else {
            // Use embed_url if visualization_type is not tableau
            $url = $detailData->embed_url;
        }

        $data = [
            'url' => $url,
            'detailData' => $detailData,
        ];

        return view('summarize', $data);
    }

    //     public function showDetail($dashboard_name)
    // {
    //     $dashboard_name = str_replace('-', ' ', $dashboard_name);

    //     $detailData = DB::table('dashboard')
    //         ->where('dashboard_name', $dashboard_name)
    //         ->first();

    //     // Get the ticket from the API
    //     $response = Http::get('http://10.2.114.197:8000/ticket');
    //     $ticket = $response->json();

    //     // Get the view_name from the detailData
    //     $viewName = $detailData->view_name;

    //     // Combine embed_url, 'trusted', ticket, and view_name to form the final URL
    //     $url = "https://tabfire.telkomsel.co.id/trusted/{$ticket}/views/{$viewName}";

    //     $data = [
    //         'url' => $url,
    //         'detailData' => $detailData,
    //     ];

    //     return view('detail', $data);
    // }

}
