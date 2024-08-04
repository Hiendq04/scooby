<?php

namespace App\Http\Controllers\Client;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    public function shop(Request $request)
    {
        $title = "Shop";
        $categories = Category::latest()
            ->where('status', 'active')
            ->paginate(15);
        $products = Product::latest()
            ->where('status', 'published')
            ->paginate(12);

        return view('Client.shop', compact('title', 'categories', 'products'));
    }
    public function shopDetail()
    {
        $title = "Shop Detail";

        return view('Client.shop_detail', compact('title'));
    }
}
