<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\Client\VerfyMail;
use App\Models\EmailVerfyToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class VerfyController extends Controller
{
    public function verfy($token = null, $email = null)
    {
        if (!$token && !$email) {
            $title = "Verfy";

            return view('Auth.verfy', compact('title'));
        }

        if (!$token || !$email) {
            return redirect()->route('verfy');
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            toastr()->error("Tài khoản không tồn tại!");

            return redirect()->route('register');
        }

        $verfy = EmailVerfyToken::where('email', $email)->where('token', $token)->first();

        if ($user->email_verified_at !== null && !$verfy) {
            toastr()->info("Tài khoản đã được xác nhận!");

            return redirect()->route('login');
        }

        if ($verfy) {
            $time = $verfy->updated_at->addMinutes(15);
            if (now()->lessThan($time)) {
                $user->update([
                    'email_verified_at' => now(),
                    'status' => 'active'
                ]);
                $verfy->delete();
                toastr()->success('Xác nhận tài khoản thành công!');

                return redirect()->route('login');
            } else {
                toastr()->warning('Email đã hết hạn!');

                return redirect()->route('verfy');
            }
        }
        toastr()->error("Thông tin xác thực không chính xác!");

        return redirect()->route('verfy');
    }
    public function handleVerfy(Request $request){
        $validator = $this->validateEmail($request);
        if($validator->fails()){
            return response()->json(['status' => 'validate', 'message'=>$validator->errors()], 200);
        }
        $user = User::where('email', $request->email)->first();
        if($user->email_verified_at !== null){
            return response()->json(['status' => 'verified', 'message' => 'Tài khoản đã được xác nhận', 200]);
        }
        $token = Str::random(40).time();
        $verfy = EmailVerfyToken::where('email', $request->email)->first();
        if($verfy && now()->lessThan($verfy->updated_at->addMinutes(10)))
            return response()->json(['status' => 'warning', 'message' => "Email xác nhận đã gửi đi trước đó!"], 200);
        else if($verfy)
            $user->verfyToken()->update(['token' => $token]);
        else
            $user->verfyToken()->create(['token' => $token, 'email' => $user->email]);
        $this->sendMailVerfy($token, $user->email);

        return response()->json(['status' => 'success', 'message'=>"Email xác nhận mới đã được gửi đi!"], 200);
    }
    public function validateEmail($request){
        $rules = [
            'email' => ['required','email','exists:users,email'],
        ];
        $messages = [
            'required' => ":attribute bắt buộc nhập",
            'email' => ":attribute không đúng định dạng",
            'exists' => ":attribute không tồn tại",
        ];
        $attributes = [
            'email' => "Email"
        ];
        $validate = Validator::make($request->all(), $rules, $messages, $attributes);

        return $validate;
    }
    public function sendMailVerfy($token, $email){
        $url = route('verfy', [$token, $email]);
        Mail::to($email)->send(new VerfyMail($url));
    }
}
