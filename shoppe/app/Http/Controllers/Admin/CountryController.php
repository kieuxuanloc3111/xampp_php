<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    // Hiển thị danh sách country
    public function index()
    {
        $countries = Country::all();
        return view('admin.country.index', compact('countries'));
    }

    // Form thêm country
    public function create()
    {
        return view('admin.country.create');
    }

    // Lưu country
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        Country::create([
            'name' => $request->name
        ]);

        return redirect()->route('admin.country.index');
    }
}
