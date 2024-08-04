<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\{
    Category,
    Product,
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Product";
        $products = Product::latest()->paginate(10);

        foreach ($products as $product) {
            $category = Category::find($product->category_id);
            $product->category_name = $category ? $category->name : 'Unknown';
        }

        $categories = Category::query()->select('id', 'name')->get();

        return view('Admin.products.index', compact('title', 'products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Product";
        $categories = Category::all();

        return view('Admin.products.create', compact('title', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $params = $request->all();

        if(!$request->image){
            toastr()->warning("Vui lòng chọn ảnh cho sản phẩm");

            return redirect()->back();
        }

        $params['image'] = $request->file('image')->store('uploads/product', 'public');

        Product::create($params);
        toastr()->success('Thêm mới sản phẩm thành công!');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = "Product";
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('Admin.products.edit', compact('title', 'product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        if($request->isMethod('PUT')){
            $params = $request->all();
            $product = Product::findOrFail($id);

            if($params == $product){
                toastr()->warning("Các thông tin chưa được thay đổi!");

                return redirect()->back();
            }

            if(!$product->image && !$request->hasFile('image')){
                toastr()->success('Thêm mới sản phẩm thành công!');

                return redirect()->back();
            }
            if($request->hasFile('image')){
                if($product->image || Storage::disk('public')->exists($product->image)){
                    Storage::disk('public')->delete($product->image);
                }
                $params['image'] = $request->file('image')->store('uploads/product', 'public');
            }

            Product::updated($params);
            toastr()->success("Cập nhật sản phẩm thành công!");

            return redirect()->route('admin.product.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        if($request->isMethod('DELETE')){
            $product = Product::findOrFail($id);
            $product->delete();

            if($product->image && Storage::disk('public')->exists($product->image)){
                Storage::disk('public')->delete($product->image);
            }
            toastr()->success("Đã xóa sản phẩm thành công!");
            // return redirect(route('admin.product.index'))->with('success', "Đã xóa sản phẩm thành công!");
            return redirect(route('admin.product.index'));
        }
    }
}
