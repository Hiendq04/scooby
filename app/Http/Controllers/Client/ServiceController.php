<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function service()
    {
        $title = "Service";

        return view('Client.service', compact('title'));
    }
}
