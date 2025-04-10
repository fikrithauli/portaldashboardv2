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

class RequestController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()->role_id != 2) {
                abort(403, 'Unauthorized');
            }

            return $next($request);
        });
    }

    // public function storePermissionRequest(Request $request)
    // {
    //     // Validasi input
    //     $validatedData = $request->validate([
    //         'application_number' => 'required',
    //         'dashboard_id' => 'required',
    //         'user_id' => 'required',
    //         'name' => 'required',
    //         'departement' => 'required',
    //         'reason' => 'required',
    //     ]);

    //     // Check if a request with the same dashboard_id, name, and request_status=0 already exists
    //     $existingRequest = DB::table('permission_request')
    //         ->where('dashboard_id', $validatedData['dashboard_id'])
    //         ->where('user_id', $validatedData['user_id'])
    //         ->where('request_status', 0)
    //         ->first();

    //     if ($existingRequest) {
    //         // If a request with the same dashboard_id, name, and request_status=0 exists, show an alert or take any other action
    //         return back()->with('error', 'This request is already in the review process.');
    //     }

    //     // If no existing request with request_status=0 is found, insert the new entry into the database
    //     DB::table('permission_request')->insert([
    //         'application_number' => $validatedData['application_number'],
    //         'dashboard_id' => $validatedData['dashboard_id'],
    //         'user_id' => $validatedData['user_id'],
    //         'name' => $validatedData['name'],
    //         'departement' => $validatedData['departement'],
    //         'reason' => $validatedData['reason'],
    //         'request_status' => 0,
    //         'created_at' => now(), // Tambahkan kolom 'created_at' dengan waktu saat ini
    //     ]);

    //     // Redirect or give a response as needed
    //     return redirect()->route('home')->with('success', 'Your request has been successfully saved.');
    // }

    public function storePermissionRequest(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'application_number' => 'required',
            'dashboard_id' => 'required',
            'user_id' => 'required',
            'name' => 'required',
            'departement' => 'required',
            'reason' => 'required',
        ]);

        // Check if a request with request_status=2 exists
        $existingRequest = DB::table('permission_request')
            ->where('dashboard_id', $validatedData['dashboard_id'])
            ->where('user_id', $validatedData['user_id'])
            ->where('request_status', 2)
            ->first();

        if ($existingRequest) {
            // If a request with request_status=2 exists, update the status to 1
            DB::table('permission_request')
                ->where('dashboard_id', $validatedData['dashboard_id'])
                ->where('user_id', $validatedData['user_id'])
                ->update(['request_status' => 0]);

            return redirect()->route('home')->with('success', 'Your previous request has been reactivated.');
        }

        // Check if a request with request_status=0 already exists
        $pendingRequest = DB::table('permission_request')
            ->where('dashboard_id', $validatedData['dashboard_id'])
            ->where('user_id', $validatedData['user_id'])
            ->where('request_status', 0)
            ->first();

        if ($pendingRequest) {
            // If a request with request_status=0 exists, show an alert
            return back()->with('error', 'This request is already in the review process.');
        }

        // If no existing request is found, insert the new entry into the database
        DB::table('permission_request')->insert([
            'application_number' => $validatedData['application_number'],
            'dashboard_id' => $validatedData['dashboard_id'],
            'user_id' => $validatedData['user_id'],
            'name' => $validatedData['name'],
            'departement' => $validatedData['departement'],
            'reason' => $validatedData['reason'],
            'request_status' => 0,
            'created_at' => now(), // Tambahkan kolom 'created_at' dengan waktu saat ini
        ]);

        // Redirect or give a response as needed
        return redirect()->route('home')->with('success', 'Your request has been successfully saved.');
    }
}
