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

use Illuminate\Http\Request;
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

    public function edit($id)
    {
        $product = Products::findOrFail($id);

        $categories = Category::all();
        $brands     = Brand::all();

        $oldImages  = json_decode($product->image, true);

        return view('frontend.product.edit', compact(
            'product',
            'categories',
            'brands',
            'oldImages'
        ));
    }

    public function update(Request $request, $id)
    {
        $product = Products::findOrFail($id);

        $dir = public_path('upload/product');
        $manager = new ImageManager(new Driver());

        $oldImages = json_decode($product->image, true) ?? [];

        $deleteImages = $request->delete_images ?? [];

        $remainingImages = array_values(array_diff($oldImages, $deleteImages));

        $newImages = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {

                if (count($remainingImages) + count($newImages) >= 3) {
                    return back()->withErrors('Tổng số hình không được vượt quá 3');
                }

                if ($file->getSize() > 1024 * 1024) {
                    return back()->withErrors('Hình vượt quá 1MB');
                }

                $name = time().'_'.$file->getClientOriginalName();

                $image = $manager->read($file);
                $image->save($dir.'/'.$name);
                $image->resize(85,84)->save($dir.'/85x84_'.$name);
                $image->resize(329,380)->save($dir.'/329x380_'.$name);

                $newImages[] = $name;
            }
        }

        $finalImages = array_merge($remainingImages, $newImages);

        if (count($finalImages) < 1) {
            return back()->withErrors('Sản phẩm phải có ít nhất 1 ảnh');
        }

        foreach ($deleteImages as $img) {
            if (in_array($img, $oldImages)) {
                @unlink($dir.'/'.$img);
                @unlink($dir.'/85x84_'.$img);
                @unlink($dir.'/329x380_'.$img);
            }
        }

        $product->update([
            'name'        => $request->name,
            'price'       => $request->price,
            'category_id' => $request->category_id,
            'brand_id'    => $request->brand_id,
            'sale'        => $request->sale,
            'sale_price'  => $request->sale == 1 ? $request->sale_price : null,
            'company'     => $request->company,
            'detail'      => $request->detail,
            'image'       => json_encode($finalImages),
        ]);

        return back()->with('success', 'cap nhat thanh cong');
    }
    public function destroy($id)
    {
        $product = Products::findOrFail($id);

        // chỉ owner mới được xoá
        if ($product->user_id !== auth()->id()) {
            abort(403);
        }

        // xoá hình ảnh vật lý
        $images = json_decode($product->image, true) ?? [];

        foreach ($images as $img) {
            @unlink(public_path('upload/product/full/'.$img));
            @unlink(public_path('upload/product/329x380/'.$img));
            @unlink(public_path('upload/product/85x84/'.$img));
        }

        // xoá record DB
        $product->delete();

        return back()->with('success', 'Delete product success');
    }

   
}
