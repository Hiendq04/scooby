<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $title = "Dashboard";

        return view('Admin.dashboard', compact('title'));
    }
}
