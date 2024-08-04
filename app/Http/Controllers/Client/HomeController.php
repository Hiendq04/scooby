<?php

namespace App\Http\Controllers\Client;

use App\Models\User;
use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $title = "Home";
        $banners = Banner::where('status', 'active')
            ->whereNotNull('image')
            ->orderBy('id', 'desc')
            ->take(2)
            ->get();


        return view('Client.home', compact('title', 'banners'));
    }
}
