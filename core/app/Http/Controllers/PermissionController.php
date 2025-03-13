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
            if (!Auth::check()) {
                return redirect()->route('login')->with('error', 'Session expired, please login again.');
            }

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

        $dashboards = DB::table('dashboard')
            ->orderBy('created_at', 'desc')
            ->groupBy('dashboard_id')
            ->get();

        $permission = DB::table('permissions')
            ->join('users', 'permissions.user_id', '=', 'users.id')
            ->leftJoin('permission_request', function ($join) {
                $join->on(DB::raw('FIND_IN_SET(permission_request.dashboard_id, permissions.dashboard_id)'), '>', DB::raw('0'));
            })
            ->join('dashboard', function ($join) {
                $join->on(DB::raw('FIND_IN_SET(dashboard.dashboard_id, permissions.dashboard_id)'), '>', DB::raw('0'));
            })
            ->select(
                'users.name as user_name',
                'users.job_title',
                'users.email',
                'users.id as user_id',
                'permissions.user_id AS reff_user',
                DB::raw('(SELECT COUNT(DISTINCT dashboard.dashboard_id) 
                  FROM permissions 
                  LEFT JOIN dashboard 
                  ON FIND_IN_SET(dashboard.dashboard_id, permissions.dashboard_id)
                  WHERE permissions.user_id = users.id 
                  AND permissions.permission_type = 1) AS dashboard_count')
            )
            ->where('users.role_id', '<>', 1)
            ->groupBy('permissions.user_id', 'users.name', 'users.job_title', 'users.id', 'permissions.user_id')
            ->get();

        // Ambil user_id dari request
        $selectedUserId = $request->input('selected_user_id');

        $permissions = DB::table('permissions AS p')
            ->join('users', 'p.user_id', '=', 'users.id')
            ->join('permission_request', 'p.dashboard_id', '=', 'permission_request.dashboard_id')
            ->join('dashboard', 'p.dashboard_id', '=', 'dashboard.dashboard_id')
            ->select('p.user_id', 'p.dashboard_id', 'p.permission_type', 'dashboard.dashboard_name')
            ->where('p.user_id', $selectedUserId)
            ->distinct()
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
            ->select(
                'permission_request.*',
                'permission_request.created_at as permission_date',
                'dashboard.*',
                'users.*'
            )
            ->join('dashboard', 'permission_request.dashboard_id', '=', 'dashboard.dashboard_id')
            ->join('users', 'permission_request.user_id', '=', 'users.id')
            ->where('permission_request.request_status', 0)
            ->orderByDesc('permission_request.created_at') // Updated orderByDesc
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

        $pendingRequests = DB::table('permission_request')
            ->where('request_status', 0)
            ->get();

        $position = $request->input('position', 'Permission');

        $header = view('partials.header', compact('categories', 'position')); // Pass the categories to the header view
        $footer = view('partials.footer', compact('position'));

        return view('permission', compact('rejected', 'requests', 'totalUsersAdmins', 'totalUsers', 'admins', 'accounts', 'permission', 'permissions', 'user', 'users', 'dashboards', 'header', 'footer', 'categories', 'pendingRequests', 'position'));
    }

    public function getPermissions(Request $request, $id)
    {
        $user = Auth::user();
        $categories = Category::all();

        $dashboardCount = DB::table('dashboard AS d')
            ->join('permissions AS p', DB::raw("FIND_IN_SET(d.dashboard_id, p.dashboard_id)"), ">", DB::raw("0"))
            ->where('p.user_id', $id)
            ->where('p.permission_type', 1)
            ->distinct()
            ->count('d.dashboard_id');

        $dashboardInnactive = DB::table('dashboard AS d')
            ->join('permissions AS p', DB::raw("FIND_IN_SET(d.dashboard_id, p.dashboard_id)"), ">", DB::raw("0"))
            ->where('p.user_id', $id)
            ->where('p.permission_type', 0)
            ->distinct()
            ->count('d.dashboard_id');

        $permissions = DB::table('permissions AS p')
            ->join('users', 'p.user_id', '=', 'users.id')
            ->leftJoin('permission_request', function ($join) {
                $join->on(DB::raw("FIND_IN_SET(permission_request.dashboard_id, p.dashboard_id)"), ">", DB::raw("0"));
            })
            ->join('dashboard', function ($join) {
                $join->on(DB::raw("FIND_IN_SET(dashboard.dashboard_id, p.dashboard_id)"), ">", DB::raw("0"));
            })
            ->select(
                'p.user_id',
                'p.dashboard_id',
                'p.permission_type',
                'users.name as applicant_name',
                'users.job_title',
                'dashboard.dashboard_name'
            )
            ->where('p.user_id', $id)
            ->distinct()
            ->get();

        $position = $request->input('position', 'Permission');

        $header = view('partials.header', compact('categories', 'position'));
        $footer = view('partials.footer', compact('position'));

        return view('permission_list', compact('permissions', 'dashboardCount', 'dashboardInnactive', 'user', 'header', 'footer', 'categories', 'position'));
    }

    public function store(Request $request)
    {
        // Ambil data dari request
        $email = $request->input('recipient_email');
        $name = $request->input('recipient_name'); // Pastikan Anda mendapatkan nama dari form
        $permissions = $request->input('permissions', []);
        $now = Carbon::now(); // Ambil tanggal dan waktu saat ini

        // Cek apakah pengguna sudah ada
        $user = User::where('email', $email)->first();

        if (!$user) {
            // Jika pengguna belum ada, tambahkan pengguna baru
            $user = User::create([
                'email' => $email,
                'name' => $name,
                'role_id' => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // Ambil user_id dari pengguna yang ada atau baru dibuat
        $user_id = $user->id;

        // Proses izin
        foreach ($permissions as $dashboard_id) {
            // Periksa apakah user_id dan dashboard_id sudah ada di tabel permissions
            $existingPermission = DB::table('permissions')
                ->where('user_id', $user_id)
                ->where('dashboard_id', $dashboard_id)
                ->first();

            if ($existingPermission) {
                // Jika permission sudah ada, update updated_at
                DB::table('permissions')
                    ->where('user_id', $user_id)
                    ->where('dashboard_id', $dashboard_id)
                    ->update([
                        'updated_at' => $now,
                    ]);
            } else {
                // Jika permission belum ada, tambahkan data baru dengan created_at dan updated_at
                DB::table('permissions')->insert([
                    'user_id' => $user_id,
                    'dashboard_id' => $dashboard_id,
                    'permission_type' => 1,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }

        return redirect()->route('permission')->with('success', 'Permissions added or updated successfully!');
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

    // public function update(Request $request, $id)
    // {
    //     $user_id = $id;
    //     $permissions = $request->input('permissions', []);

    //     $now = now(); // Ambil tanggal dan waktu saat ini

    //     // Dapatkan semua data permissions untuk user tersebut
    //     $existingPermissions = DB::table('permissions')
    //         ->where('user_id', $user_id)
    //         ->get();

    //     // Perbarui permission_type berdasarkan user_id dan dashboard_id
    //     foreach ($existingPermissions as $existingPermission) {
    //         $dashboard_id = $existingPermission->dashboard_id;

    //         // Periksa apakah dashboard_id ada dalam array permissions yang baru
    //         $isChecked = in_array($dashboard_id, $permissions);

    //         // Update permission_type sesuai dengan kondisi
    //         DB::table('permissions')
    //             ->where('user_id', $user_id)
    //             ->where('dashboard_id', $dashboard_id)
    //             ->update([
    //                 'permission_type' => $isChecked ? 1 : 0,
    //                 'updated_at' => $now,
    //             ]);
    //     }

    //     return redirect()->route('permission')->with('success', 'Permissions updated successfully!');
    // }

    public function update(Request $request, $id)
    {
        $user_id = $id;
        $permissions = $request->input('permissions', []);

        $now = now(); // Get the current date and time

        foreach ($permissions as $permission) {
            $dashboard_id = $permission['dashboard_id'];

            // Update permission_type based on the condition
            DB::table('permissions')
                ->where('user_id', $user_id)
                ->where('dashboard_id', $dashboard_id)
                ->update([
                    'permission_type' => $permission['permission_type'] ?? 0,
                    'updated_at' => $now,
                ]);
        }

        return response()->json(['success' => true, 'message' => 'Permissions updated successfully']);
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
                // If permission already exists, add a new row to permissions table
                $now = Carbon::now();
                DB::table('permissions')->insert([
                    'user_id' => $user->id,
                    'dashboard_id' => $request->dashboard_id,
                    'permission_type' => 1,
                    'created_at' => $now,
                    'updated_at' => $now,
                    // You can add other fields here as needed
                ]);
            } else {
                // Insert permission data into permissions table
                $now = Carbon::now();
                DB::table('permissions')->insert([
                    'user_id' => $user->id,
                    'dashboard_id' => $request->dashboard_id,
                    'permission_type' => 1,
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

    public function approveAllRequests(Request $request)
    {
        // Get the list of request IDs from the request data
        $requestIds = $request->input('requestIds', []);

        // Loop through each request ID and update the corresponding request
        foreach ($requestIds as $requestId) {
            // Update status permintaan menjadi 1 (approve)
            DB::table('permission_request')->where('request_id', $requestId)->update([
                'request_status' => 1,
                'updated_at' => now(), // Update timestamp
            ]);

            // Get the request details
            $requestItem = DB::table('permission_request')->where('request_id', $requestId)->first();

            if (!$requestItem) {
                // If request item not found, continue to the next request
                continue;
            }

            // Ambil data pengguna berdasarkan nama
            $user = DB::table('users')->where('name', $requestItem->name)->first();

            if (!$user) {
                // Jika pengguna tidak ditemukan, lanjutkan ke permintaan berikutnya
                continue; // Atau Anda bisa mengembalikan error
            }

            // Cek apakah izin sudah ada untuk pengguna dan dashboard
            $existingPermission = DB::table('permissions')
                ->where('user_id', $user->id)
                ->where('dashboard_id', $requestItem->dashboard_id) // Pastikan untuk memeriksa dashboard_id
                ->first();

            // Jika izin sudah ada, Anda bisa memutuskan untuk tidak melakukan apa-apa atau memperbarui
            if (!$existingPermission) {
                // Masukkan data izin baru ke tabel permissions
                DB::table('permissions')->insert([
                    'user_id' => $user->id,
                    'dashboard_id' => $requestItem->dashboard_id,
                    'permission_type' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }

        // Kembalikan respons sukses
        return response()->json(['message' => 'Selected requests approved successfully!']);
    }


    public function getEmails()
    {
        try {
            $emails = DB::table('recipients')->select('email')->get();
            return response()->json(['success' => true, 'emails' => $emails]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function getRecipientDetails(Request $request)
    {
        $email = $request->input('email');

        if (!$email) {
            return response()->json(['success' => false, 'message' => 'Email is required.']);
        }

        try {
            $recipient = DB::table('recipients')->where('email', $email)->first();

            if ($recipient) {
                return response()->json(['success' => true, 'name' => $recipient->name, 'job_title' => $recipient->job_title]);
            } else {
                return response()->json(['success' => false, 'message' => 'Recipient not found.']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()]);
        }
    }
}
