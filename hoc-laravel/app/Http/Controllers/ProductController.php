<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // 1. DANH SÁCH PRODUCT
    public function index()
    {
        $products = Product::with('category')
            ->orderBy('id', 'desc')
            ->get();

        return view('products.index', compact('products'));
    }

    // 2. FORM TẠO PRODUCT
    public function create()
    {
        $categories = Category::all();

        return view('products.create', compact('categories'));
    }

    // 3. LƯU PRODUCT
    public function store(Request $request)
    {
        Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'price' => $request->price,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
            'status' => 'published',
            'is_active' => true,
        ]);

        return redirect('/products');
    }
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
    }
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'price' => $request->price,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
        ]);

        return redirect('/products');

    }
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect('/products');
    }


}
