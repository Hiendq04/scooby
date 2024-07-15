<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckOutController extends Controller
{
    public function checkOut(){
        $title = "Check Out";

        return view('Client.check_out', compact('title'));
    }
}
