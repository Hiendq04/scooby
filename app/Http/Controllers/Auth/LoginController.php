<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login()
    {
        $title = "Log in";

        return view('Auth.login', compact('title'));
    }
    public function handleLogin(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $user = User::where('email', $email)->first();

        if (!$user) {
            toastr()->error("Email không tồn tại trên hệ thống!");
            return redirect()->back();
        }

        if (!Hash::check($password, $user->password)) {
            toastr()->error("Mật khẩu không chính xác!");
            return redirect()->back();
        }

        if ($user->provider != null) {
            toastr()->warning("Email này sử dụng phương thức đăng nhập khác!");
            return redirect()->back();
        }

        if ($user->email_verified_at == null) {
            toastr()->warning("Tài khoản chưa được xác thực! Vui lòng xác thực tài khoản!");
            return redirect()->route('verfy');
        }

        if($user->status == 'inactive'){
            toastr()->error("Tài khoản của bạn đã bị khóa!");
            return redirect()->back();
        }

        $credentials = ['email' => $email, 'password' => $password];

        if (Auth::attempt($credentials)) {
            toastr()->success("Đăng nhập thành công!");

            return redirect()->route('/');
        } else {
            toastr()->error("Đăng nhập không thành công! Vui lòng thử lại!");
            return redirect()->back();
        }

    }
    public function logout()
    {
        Auth::logout();
        toastr()->success("Đăng xuất thành công!");

        return redirect()->route('/');
    }
}
