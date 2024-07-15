<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\Client\VerfyMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function register(){
        $title = "Register";
        return view('Auth.register', compact('title'));
    }
    public function handleRegister(Request $request){
        $validator = $this->validateRegister($request);
        if($validator->fails()){
            return response()->json(['status' => "validate", 'message' => $validator->errors()],200);
        }else if($request->check == "false"){
            return response()->json(['status' => "check", "message" => "Vui lòng đồng ý với điều khoản và dịch vụ"], 200);
        }
        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];
        $user = User::create($data);
        $token = Str::random(40).time();
        $user->verfyToken()->create([
            'token' => $token,
            'email' => $user->email,
        ]);
        $this->sendMailVerfy($token, $data['email']);

        return response()->json(['status' => 'success', 'message' => "Vui lòng xác nhận email trong 15 phút để hoàn tất quá trình đăng ký!"], 200);
    }
    public function sendMailVerfy($token, $email){
        $url = route('verfy', [$token, $email]);
        Mail::to($email)->send(new VerfyMail($url));
    }
    public function validateRegister($request){
        $rules = [
            'first_name'  => ['required', 'max:20'],
            'last_name' => ['required', 'max:20'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8', 'max:40'],
            'repassword' => ['required', 'min:8', 'max:40', 'same:password']
        ];
        $messages = [
            'required' => ":attribute bắt buộc nhập",
            'email' => "Email không đúng định dạng",
            'min' => ":attribute tối thiểu :min ký tự",
            'max' => ":attribute tối đa :max ký tự",
            'same' => ":attribute không trùng khớp",
            'unique' => ":attribute đã tồn tại"
        ];
        $attributes = [
            'first_name' => "Tên",
            'last_name' => "Họ",
            'email' => 'Email',
            'password' => 'Mật khẩu',
            'repassword' => 'Xác nhận mật khẩu',
        ];

        $validate = Validator::make($request->all(),$rules, $messages, $attributes);

        return $validate;
    }
}
