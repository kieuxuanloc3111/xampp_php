<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Products;

class HomeController extends Controller
{
    public function index()
    {
        $products = Products::orderBy('updated_at', 'desc')
            ->take(6)
            ->get();


        return view('frontend.home.index', compact('products'));
    }
}
