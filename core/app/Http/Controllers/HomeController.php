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

        // $header = view('partials.header', compact('categories', 'position'));
        $footer = view('partials.footer', compact('position'));

        // Ambil semua data dashboard dari tabel dashboard
        $query = DB::table('dashboard')
            ->join('categories', 'dashboard.category_id', '=', 'categories.category_id')
            ->select('dashboard.*', 'categories.*');

        // Ambil data kategori yang dipilih dari form
        $selectedCategoryIds = $request->input('category_id');

        // Jika 'All Categories' dipilih, tidak perlu menambahkan kriteria filter untuk kolom kategori.
        if ($selectedCategoryIds && in_array(
            'all',
            $selectedCategoryIds
        )) {
            // Do nothing, show all dashboards.
        } elseif ($selectedCategoryIds) {
            $query->whereIn('dashboard.category_id', $selectedCategoryIds);
        }

        // Urutkan data berdasarkan 'created_at' secara descending (desc).
        $query->orderByDesc('dashboard.created_at');

        // Eksekusi query dan ambil data dashboard yang sudah difilter
        $filteredData = $query->get();

        // Inisialisasi array untuk menyimpan ID dashboard yang diizinkan
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
            $allowedDashboardIds = $filteredData->pluck('dashboard_id')->toArray();
        }

        return view('home', compact('user', 'footer', 'filteredData', 'categories', 'position', 'allowedDashboardIds'));
    }

    // public function showDetail($dashboard_name)
    // {
    //     // Replace '-' with ' ' to convert it back to the original name
    //     $dashboard_name = str_replace('-', ' ', $dashboard_name);

    //     // Fetch the data based on the provided dashboard_name
    //     $detailData = DB::table('dashboard')
    //         ->where('dashboard_name', $dashboard_name)
    //         ->first();

    //     return view('detail', compact('cleanedEmbedUrl'));
    // }

    // public function showDetail($dashboard_name)
    // {
    //     $dashboard_name = str_replace('-', ' ', $dashboard_name);

    //     $detailData = DB::table('dashboard')
    //         ->where('dashboard_name', $dashboard_name)
    //         ->first();

    //     // Get the ticket from the API
    //     $response = Http::get('http://10.2.114.197:8000/ticket');
    //     $ticket = $response->json();

    //     $url = "https://tabfire.telkomsel.co.id/trusted/{$ticket}/views/HMS-Dashboard/1_Cover";

    //     $data = [
    //         'url' => $url,
    //         'detailData' => $detailData,
    //     ];

    //     return view('detail', $data);
    // }

    public function showDetail($dashboard_name)
{
    $dashboard_name = str_replace('-', ' ', $dashboard_name);

    $detailData = DB::table('dashboard')
        ->where('dashboard_name', $dashboard_name)
        ->first();

    // Get the ticket from the API
    $response = Http::get('http://10.2.114.197:8000/ticket');
    $ticket = $response->json();

    // Get the view_name from the detailData
    $viewName = $detailData->view_name;

    // Combine embed_url, 'trusted', ticket, and view_name to form the final URL
    $url = "https://tabfire.telkomsel.co.id/trusted/{$ticket}/views/{$viewName}";

    $data = [
        'url' => $url,
        'detailData' => $detailData,
    ];

    return view('detail', $data);
}

}
