<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function shop(){
        $title = "Shop";

        return view('Client.shop', compact('title'));
    }
    public function shopDetail(){
        $title = "Shop Detail";

        return view('Client.shop_detail', compact('title'));
    }
}
