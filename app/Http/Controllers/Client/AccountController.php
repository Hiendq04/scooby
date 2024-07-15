<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function info()
    {
        $title = "Account";
        $account = User::where('id', auth()->id())->first();

        return view('Client.account', compact('title', 'account'));
    }
    // public function getInfoAccount()
    // {
    //     $id = Auth::id();
        
    //     return response()->json(['id' => $id], 200);
    // }
}
