<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function list()
    {
        $title = 'Category';

        return view('Admin.category_list', compact('title'));
    }
    public function getCategories(Request $request)
    {
        $keyword = $request->keyword;
        $perPage = $request->count;

        $categories = Category::select('id', 'name', 'description', 'created_at', 'status')
            ->orderBy('id', 'desc');

        if (!empty($keyword)) {
            $categories->where(function ($query) use ($keyword) {
                $query->where('name', 'LIKE', '%' . $keyword . '%');
            });
        }

        $categories = $categories->paginate($perPage);

        $categories->getCollection()->transform(function ($category) {
            return [
                'id' => $category->id,
                'name' => $category->name,
                'date' => $category->created_at->format('d/m/Y'),
                'description' => $category->description,
                'status' => $category->status,
            ];
        });

        return response()->json($categories, 200);
    }
    public function add()
    {
        $title = 'Category';

        return view('Admin.category_add', compact('title'));
    }
    public function handleAddCategory(Request $request)
    {
        if (!$request->name)
            return response()->json(['type' => 'warning', 'data' => 'Vui lòng điền tên danh mục!'], 200);
        if (!$request->description)
            return response()->json(['type' => 'warning', 'data' => 'Vui lòng điền mô tả danh mục!'], 200);
        if (!$request->status)
            return response()->json(['type' => 'warning', 'data' => 'Vui lòng chọn trạng thái!'], 200);

        Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'thumbnail' => $request->thumbnail,
            'status' => $request->status,
        ]);
        return response()->json(['type' => 'success', 'data' => 'Thêm mới danh mục thành công!'], 200);
    }
    public function deleteCategory(Request $request)
    {
        Category::find($request->id)->delete();

        return response()->json('Đã xóa thành công!');
    }
    public function edit($idCat)
    {
        $title = "Category";
        $category = Category::find($idCat);
        if(!$category)
            return redirect()->route('admin.category.list');

        return view('Admin.category_edit', compact('title', 'category'));
    }
    public function updateCategory(Request $request)
    {
        $category = Category::find($request->id);
        if ((!$request->thumbnail) && ($request->name == $category->name) && ($request->description == $category->description) && ($request->status == $category->status))
            return response()->json(['type' => 'warning', 'data' => 'Hãy chỉnh sửa trước khi cập nhật!']);

        if (!$request->name)
            return response()->json(['type' => 'warning', 'data' => 'Vui lòng điền tên danh mục!']);

        if (!$request->description)
            return response()->json(['type' => 'warning', 'data' => 'Vui lòng điền mô tả danh mục!']);

        if ($request->thumbnail)
            $category->update($request->all());
        else
            $category->update([
                'name' => $request->name,
                'description' => $request->description,
                'status' => $request->status,
            ]);

        return response()->json(['type' => 'success', 'data' => "Cập nhật thành công!"]);
    }
}
