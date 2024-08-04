<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BannerRequest;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Banner";
        $banners = Banner::orderBy('id', 'desc')->paginate(10);

        return view('Admin.banners.index', compact('title', 'banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Product";

        return view('Admin.banners.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BannerRequest $request)
    {
        if ($request->isMethod('POST')) {
            $params = $request->all();
            $params['image'] = $request->file('image')->store('uploads/banner', 'public');

            Banner::create($params);

            toastr()->success('Thêm bảng quảng cáo thành công');

            return redirect()->route('admin.banner.index');
        }
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
        $banner = Banner::findOrFail($id);

        return view('Admin.banners.edit', compact('title', 'banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BannerRequest $request, string $id)
    {
        if ($request->isMethod("PUT")) {
            $banner = Banner::findOrFail($id);

            $params = $request->all();

            if ($request->has('image')) {
                if ($banner->image && Storage::disk('public')->exists($banner->image)) {
                    Storage::disk('public')->delete($banner->image);
                }
                $params['image'] = $request->file('image')->store('uploads/banner', 'public');
            } else {
                $params['image'] = $banner->image;
            }

            $banner->update($params);

            toastr()->success('Cập nhật thành công');

            return redirect()->route('admin.banner.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        if ($request->isMethod("DELETE")) {
            $banner = Banner::findOrFail($id);
            $banner->delete();

            if ($banner->image && Storage::disk('public')->exists($banner->image)) {
                Storage::disk('public')->delete($banner->image);
            }

            toastr()->success('Đã xóa bảng quảng cáo thành công!');

            return redirect()->route('admin.banner.index');
        }
    }


    // Update status api
    public function updateStatus(Request $request)
    {
        $banner = Banner::findOrFail($request->id);

        if ($banner) {
            $banner->status = $request->status;
            $banner->save();

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
