<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Member\ProductRequest;
use App\Models\Products;
use App\Models\Category;
use App\Models\Brand;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Auth;
class ProductController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();

        return view('frontend.product.add', compact('categories', 'brands'));
    }

    public function store(ProductRequest $request)
    {
        $dir = public_path('upload/product');

        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        $images = [];

        $manager = new ImageManager(new Driver());

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {

                $name = time() . '_' . $file->getClientOriginalName();

                $fullPath   = public_path('upload/product/' . $name);
                $smallPath  = public_path('upload/product/85x84_' . $name);
                $mediumPath = public_path('upload/product/329x380_' . $name);

                $image = $manager->read($file);

                $image->save($fullPath);
                $image->resize(85, 84)->save($smallPath);
                $image->resize(329, 380)->save($mediumPath);

                $images[] = $name;
            }
        }

        Products::create([
            'name'        => $request->name,
            'price'       => $request->price,
            'sale'        => $request->sale,
            'sale_price'  => $request->sale_price,
            'company'     => $request->company,
            'detail'      => $request->detail,
            'status'      => 0, 
            'category_id' => $request->category_id,
            'brand_id'    => $request->brand_id,
            'image'       => json_encode($images),
            'user_id'     => auth()->id(),
        ]);


        return back()->with('success', 'Add product success');
    }
    public function myProduct()
    {
        $products = Products::where('user_id', Auth::id())
            ->orderBy('id', 'desc')
            ->get();

        return view('frontend.product.my_product', compact('products'));
    }
}
