<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Dashboard;
use App\Models\Category;


class CategoryController extends Controller
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

        $position = $request->input('position', 'Content');
        $header = view('partials.header', compact('categories', 'position'));
        $footer = view('partials.footer', compact('position'));



        return view('content.category', compact('categories', 'header', 'footer', 'user', 'position'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'category_name'       => 'required|max:255',
        ]);

        // Menggunakan query builder untuk menyimpan data categories baru
        DB::table('categories')->insert(['category_name' => $validatedData['category_name'],]);

        // Redirect atau berikan respons sesuai kebutuhan
        return redirect()->route('categories')->with('success', 'Category added successfully');
    }

    public function update(Request $request, Category $category)
    {
        // Validasi input
        $validatedData = $request->validate([
            'category_name' => 'required|max:255',
            // Tambahkan validasi untuk field lainnya jika diperlukan
        ]);

        // Perbarui data kategori
        $category->category_name = $validatedData['category_name'];
        // Setel nilai field lainnya sesuai kebutuhan

        // Simpan perubahan
        $category->save();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('categories')->with('success', 'Category updated successfully');
    }

    public function destroy($id)
    {
        $categories = DB::table('categories')->where('category_id', $id)->first();

        DB::table('categories')->where('category_id', $id)->delete();

        return redirect()->route('categories')->with('success', 'Category delete successfully');
    }
}
