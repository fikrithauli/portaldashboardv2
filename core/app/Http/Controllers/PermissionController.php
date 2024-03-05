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

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()->role_id != 1) {
                abort(403, 'Unauthorized');
            }

            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $user = Auth::user();

        $categories = Category::all();

        // Mengambil semua dashboard dari tabel dashboard
        $dashboards = DB::table('dashboard')
            ->orderBy('created_at', 'desc')
            ->distinct('dashboard_id') // Menggunakan kolom ID sebagai kolom yang unik
            ->get();

        // Melakukan join antara tabel permissions dan users berdasarkan user_id
        $permission = DB::table('permissions')
            ->join('users', 'permissions.user_id', '=', 'users.id')
            ->join('permission_request', 'permissions.dashboard_id', '=', 'permission_request.dashboard_id')
            ->join('dashboard', 'permissions.dashboard_id', '=', 'dashboard.dashboard_id')
            ->select('permissions.*', 'permission_request.*', 'permissions.dashboard_id AS permission_type', 'users.*', 'users.name as user_name', 'dashboard.dashboard_name')
            ->get();

        $accounts = DB::table('users')
            ->select('users.*')
            ->where('role_id', 2)
            ->orderByDesc('created_at')
            ->take(5)
            ->get();

        $admins = DB::table('users')
            ->select('users.*')
            ->where('role_id', 1)
            ->orderByDesc('created_at')
            ->take(5)
            ->get();

        // Melakukan join antara tabel permissions dan users berdasarkan user_id
        $requests = DB::table('permission_request')
            ->select('*')
            ->join('dashboard', 'permission_request.dashboard_id', '=', 'dashboard.dashboard_id')
            ->where('permission_request.request_status', 0)
            ->get();

        // Melakukan join antara tabel permissions dan users berdasarkan user_id
        $rejected = DB::table('permission_request')
            ->select('*', 'permission_request.dashboard_id AS permission_type', 'permission_request.created_at AS request_date')
            ->join('dashboard', 'permission_request.dashboard_id', '=', 'dashboard.dashboard_id')
            ->where('permission_request.request_status', 2)
            ->get();

        // Count the total number of users with role_id 1
        $totalUsersAdmins = DB::table('permission_request')
            ->where('request_status', 1)
            ->count();

        // Count the total number of users with role_id 2
        $totalUsers = DB::table('permission_request')
            ->where('request_status', 2)
            ->count();

        // Mengambil hanya pengguna dengan role_id 2 dari tabel users
        $users = User::where('role_id', 2)->get();


        $position = $request->input('position', 'Permission');

        $header = view('partials.header', compact('categories', 'position')); // Pass the categories to the header view
        $footer = view('partials.footer', compact('position'));

        return view('permission', compact('rejected', 'requests', 'totalUsersAdmins', 'totalUsers', 'admins', 'accounts', 'permission', 'user', 'users', 'dashboards', 'header', 'footer', 'categories', 'position'));
    }

    public function store(Request $request)
    {
        $user_id = $request->input('user_id');
        $permissions = $request->input('permissions', []);

        // Konversi array $permissions menjadi string
        $dashboard_ids = implode(',', $permissions);

        // Periksa apakah user_id sudah ada di tabel permissions
        $existingPermission = DB::table('permissions')->where('user_id', $user_id)->first();

        if ($existingPermission) {
            // Jika user_id sudah ada di database, tampilkan pesan alert
            return redirect()->route('permission')->with('error', 'User permissions already exist!');
        }

        // Jika user_id belum ada, tambahkan data baru dengan created_at dan updated_at
        $now = Carbon::now(); // Ambil tanggal dan waktu saat ini
        DB::table('permissions')->insert([
            'user_id' => $user_id,
            'dashboard_id' => $dashboard_ids,
            'created_at' => $now,
            'updated_at' => $now,
            // Anda bisa menambahkan field lain di sini sesuai kebutuhan
        ]);

        return redirect()->route('permission')->with('success', 'Permissions added successfully!');
    }


    public function edit($id)
    {
        $user = User::find($id);
        $dashboards = DB::table('dashboard')->get();
        $permissions = DB::table('permissions')
            ->where('user_id', $id)
            ->pluck('dashboard_id')
            ->toArray();

        return view('edit_permission', compact('user', 'dashboards', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        $user_id = $id;
        $permissions = $request->input('permissions', []);

        // Konversi array $permissions menjadi string
        $dashboard_ids = implode(',', $permissions);

        // Periksa apakah user_id sudah ada di tabel permissions
        $existingPermission = DB::table('permissions')->where('user_id', $user_id)->first();

        $now = Carbon::now(); // Ambil tanggal dan waktu saat ini

        if ($existingPermission) {
            // Jika user_id sudah ada, update dashboard_id dan updated_at
            DB::table('permissions')->where('user_id', $user_id)->update([
                'dashboard_id' => $dashboard_ids,
                'updated_at' => $now,
                // Anda bisa menambahkan field lain di sini sesuai kebutuhan
            ]);
        } else {
            // Jika user_id belum ada, tambahkan data baru dengan created_at dan updated_at
            DB::table('permissions')->insert([
                'user_id' => $user_id,
                'dashboard_id' => $dashboard_ids,
                'created_at' => $now,
                'updated_at' => $now,
                // Anda bisa menambahkan field lain di sini sesuai kebutuhan
            ]);
        }

        return redirect()->route('permission')->with('success', 'Permissions updated successfully!');
    }

    public function approvePermissionRequest($requestId)
    {
        // Check if the request with the specified request_id exists
        $request = DB::table('permission_request')->where('request_id', $requestId)->first();

        if (!$request) {
            // If the request does not exist, show an error message or redirect back with an error
            return back()->with('error', 'Request not found.');
        }

        if ($request->request_status == 0) {
            // If the request_status is 0, update it to 1 (approve)
            DB::table('permission_request')->where('request_id', $requestId)->update([
                'request_status' => 1,
                'updated_at' => now(), // Update the 'updated_at' timestamp
            ]);

            // Get user data from permission list based on the requested name
            $user = DB::table('users')->where('name', $request->name)->first();

            if (!$user) {
                // If user not found, show an error message or take appropriate action
                return back()->with('error', 'User not found in permission list.');
            }

            // Check if permission already exists for the user and dashboard
            $existingPermission = DB::table('permissions')
                ->where('user_id', $user->id)
                ->first();

            if ($existingPermission) {
                // If permission already exists, update dashboard_id
                $newDashboardIds = implode(',', array_unique(array_merge(explode(',', $existingPermission->dashboard_id), [$request->dashboard_id])));

                DB::table('permissions')->where('user_id', $user->id)->update([
                    'dashboard_id' => $newDashboardIds,
                    'updated_at' => now(),
                ]);
            } else {
                // Insert permission data into permissions table
                $now = Carbon::now();
                DB::table('permissions')->insert([
                    'user_id' => $user->id,
                    'dashboard_id' => $request->dashboard_id,
                    'created_at' => $now,
                    'updated_at' => $now,
                    // You can add other fields here as needed
                ]);
            }

            // Redirect or give a response as needed
            return redirect()->route('permission')->with('success', 'Request approved successfully.');
        } else {
            // If the request_status is not 0 (already approved or in review), show a message or take any other action
            return back()->with('error', 'Request is already approved or in review.');
        }
    }

    public function rejectPermissionRequest($requestId)
    {
        // Check if the request with the specified request_id exists
        $request = DB::table('permission_request')->where('request_id', $requestId)->first();

        if (!$request) {
            // If the request does not exist, show an error message or redirect back with an error
            return back()->with('error', 'Request not found.');
        }

        if ($request->request_status == 0) {
            // If the request_status is 0, update it to 2 (reject)
            DB::table('permission_request')->where('request_id', $requestId)->update([
                'request_status' => 2,
                'updated_at' => now(),
            ]);

            // Redirect or give a response as needed
            return redirect()->route('permission')->with('success', 'Request rejected successfully.');
        } elseif ($request->request_status == 1) {
            // If the request_status is 1 (already approved), show a message or take any other action
            return back()->with('error', 'Request is already approved.');
        } else {
            // If the request_status is not 0 or 1 (in review or rejected), show a message or take any other action
            return back()->with('error', 'Request is already rejected.');
        }
    }
}
