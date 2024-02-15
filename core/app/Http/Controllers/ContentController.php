<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Dashboard;
use App\Models\Category;


class ContentController extends Controller
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

    public function dashboard(Request $request)
    {
        $user = Auth::user();

        // Use the query builder to retrieve categories
        $categories = DB::table('categories')->get();

        $position = $request->input('position', 'Content');

        $header = view('partials.header', compact('categories', 'position'));
        $footer = view('partials.footer', compact('position'));

        // Use the query builder to join dashboard and categories tables and order by created_at
        $dashboards = DB::table('dashboard')
            ->join('categories', 'dashboard.category_id', '=', 'categories.category_id')
            ->orderByDesc('dashboard.created_at')
            ->get();

        return view('content.dashboard', compact('dashboards', 'header', 'footer', 'user', 'categories', 'position'));
    }

    public function dashboardAdd(Request $request)
    {
        $user = Auth::user();

        // Use the query builder to retrieve categories
        $categories = DB::table('categories')->get();

        $position = $request->input('position', 'Content');

        $header = view('partials.header', compact('categories', 'position'));
        $footer = view('partials.footer', compact('position'));

        return view('content.dashboardAdd', compact('header', 'footer', 'user', 'categories', 'position'));
    }

    public function dashboardStore(Request $request)
    {
        try {
            // Memastikan bahwa semua field yang diperlukan diisi
            $requiredFields = ['category_id', 'dashboard_name', 'description', 'visualization_type', 'embed_url'];
            foreach ($requiredFields as $field) {
                if (!$request->filled($field)) {
                    // Redirect dengan pesan kesalahan jika ada field yang tidak diisi
                    return redirect()->route('content-dashboard')->with('error', 'All fields are required');
                }
            }

            // Mengunggah gambar jika ada
            $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();

                $image->move(base_path('uploads'), $imageName);

                $imagePath = $imageName;
            }

            // Menggunakan Query Builder untuk menyimpan data ke dalam tabel dashboard
            DB::table('dashboard')->insert([
                'category_id' => $request->input('category_id'),
                'dashboard_name' => $request->input('dashboard_name'),
                'description' => $request->input('description'),
                'visualization_type' => $request->input('visualization_type'),
                'embed_url' => $request->input('embed_url'),
                'view_name' => $request->input('view_name'),
                'image' => $imagePath,
                'dashboard_status' => 1,
                'created_at' => now(),
            ]);

            // Redirect atau berikan respons sesuai kebutuhan
            return redirect()->route('content-dashboard')->with('success', 'Dashboard added successfully');
        } catch (\Exception $e) {
            // Tampilkan pesan kesalahan dan redirect dengan pesan kesalahan
            dd($e->getMessage());
            // Atau bisa juga ditangani dengan cara lain, seperti me-redirect kembali dengan pesan error
            // return redirect()->route('content-dashboard')->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function dashboardEdit($id)
    {
        $user = Auth::user();
        $categories = DB::table('categories')->get();

        $dashboard = DB::table('dashboard')->where('dashboard_id', $id)->first();

        if (!$dashboard) {
            return redirect()->route('content-dashboard')->with('error', 'Dashboard not found');
        }

        $position = 'Edit Dashboard'; // Atur judul halaman sesuai kebutuhan

        $header = view('partials.header', compact('categories', 'position'));
        $footer = view('partials.footer', compact('position'));

        return view('content.dashboardEdit', compact('dashboard', 'header', 'footer', 'user', 'categories', 'position'));
    }


    // public function dashboardUpdate(Request $request, $id)
    // {
    //     // Retrieve the old dashboard data
    //     $oldDashboard = DB::table('dashboard')->where('dashboard_id', $id)->first();

    //     // Validasi input
    //     $validatedData = $request->validate([
    //         'category_id' => 'required',
    //         'dashboard_name' => 'required|max:255',
    //         'description' => 'required',
    //         'visualization_type' => 'required',
    //         'embed_url' => 'required',
    //         'view_name' => 'required',
    //         'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Hanya menerima file gambar dengan ekstensi yang diizinkan (jpeg, png, jpg, gif) dengan ukuran maksimum 2MB
    //     ]);

    //     // Mengunggah gambar jika ada
    //     $imagePath = $oldDashboard->image; // Default to the old image
    //     if ($request->hasFile('image')) {
    //         $image = $request->file('image');
    //         $imageName = time() . '_' . $image->getClientOriginalName();
    //         $image->move(base_path('uploads'), $imageName);
    //         $imagePath = $imageName; // Use the new image if available

    //         // Hapus gambar lama jika ada
    //         if ($oldDashboard && $oldDashboard->image) {
    //             $oldImagePath = public_path('uploads/' . $oldDashboard->image);
    //             if (file_exists($oldImagePath)) {
    //                 unlink($oldImagePath);
    //             }
    //         }
    //     }

    //     // Menggunakan query builder untuk mengupdate data dashboard
    //     DB::table('dashboard')->where('dashboard_id', $id)->update([
    //         'category_id' => $validatedData['category_id'],
    //         'dashboard_name' => $validatedData['dashboard_name'],
    //         'description' => $validatedData['description'],
    //         'visualization_type' => $validatedData['visualization_type'],
    //         'embed_url' => $validatedData['embed_url'],
    //         'view_name' => $validatedData['view_name'],
    //         'image' => $imagePath, // Use the new image path
    //     ]);

    //     // Redirect atau berikan respons sesuai kebutuhan
    //     return redirect()->route('content-dashboard')->with('success', 'Dashboard updated successfully');
    // }

    public function dashboardUpdate(Request $request, $id)
    {
        // Retrieve the old dashboard data
        $oldDashboard = DB::table('dashboard')->where('dashboard_id', $id)->first();

        // Mengunggah gambar jika ada
        $imagePath = $oldDashboard->image; // Default to the old image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(base_path('uploads'), $imageName);
            $imagePath = $imageName; // Use the new image if available

            // Hapus gambar lama jika ada
            if ($oldDashboard && $oldDashboard->image) {
                $oldImagePath = public_path('uploads/' . $oldDashboard->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
        }

        // Menggunakan query builder untuk mengupdate data dashboard
        DB::table('dashboard')->where('dashboard_id', $id)->update([
            'category_id' => $request->input('category_id'),
            'dashboard_name' => $request->input('dashboard_name'),
            'description' => $request->input('description'),
            'visualization_type' => $request->input('visualization_type'),
            'embed_url' => $request->input('embed_url'),
            'view_name' => $request->input('view_name'),
            'image' => $imagePath, // Use the new image path
        ]);

        // Redirect atau berikan respons sesuai kebutuhan
        return redirect()->route('content-dashboard')->with('success', 'Dashboard updated successfully');
    }



    public function dashboardDestroy($id)
    {
        $dashboard = DB::table('dashboard')->where('dashboard_id', $id)->first();

        if (!$dashboard) {
            return redirect()->route('about')->with('error', 'Dashboard not found');
        }

        if ($dashboard->image) {
            $imagePath = base_path('uploads/' . $dashboard->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        DB::table('dashboard')->where('dashboard_id', $id)->delete();

        return redirect()->route('content-dashboard')->with('success', 'Dashboard deleted successfully');
    }

    public function truncateTable(Request $request)
    {
        // Lakukan truncate pada tabel yang ingin Anda hapus datanya
        DB::table('dashboard')->truncate();

        return redirect()->route('content-dashboard')->with('success', 'Data berhasil dihapus.');
    }

    public function serviceInterruption(Request $request)
    {
        $user = Auth::user();

        // Use the query builder to retrieve categories
        $categories = DB::table('categories')->get();

        $position = $request->input('position', 'Content');

        $header = view('partials.header', compact('categories', 'position'));
        $footer = view('partials.footer', compact('position'));

        // Use the query builder to join dashboard and categories tables and order by created_at
        $dashboards = DB::table('dashboard')
            ->join('categories', 'dashboard.category_id', '=', 'categories.category_id')
            ->orderByDesc('dashboard.created_at')
            ->get();

        return view('content.service_interruption', compact('dashboards', 'header', 'footer', 'user', 'categories', 'position'));
    }

    public function changeStatus(Request $request)
    {
        $dashboardId = $request->input('dashboardId');
        $status = $request->input('status');

        // Update status menggunakan Query Builder
        DB::table('dashboard')
            ->where('dashboard_id', $dashboardId)
            ->update(['dashboard_status' => $status == 'maintenance' ? 0 : 1]);

        return response()->json(['message' => 'Dashboard status changed']);
    }
}
