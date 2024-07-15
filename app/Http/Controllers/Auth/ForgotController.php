<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\Client\ResetPasswordMail;
use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ForgotController extends Controller
{
    public function forgot()
    {
        $title = "Forgot";

        return view('Auth.forgot', compact('title'));
    }
    public function handleForgot(Request $request)
    {
        $validator = $this->validateEmail($request);
        if ($validator->fails()) {
            return response()->json(['status' => 'validate', 'message' => $validator->errors()], 200);
        }
        $user = User::where('email', $request->email)->first();
        if ($user && $user->email_verified_at === null)
            return response()->json(['status' => 'unverified', 'message' => "Tài khoản của bạn chưa được xác thực!"]);
        if ($user && $user->status === 'inactive')
            return response()->json(['status' => 'inactive', 'message' => "Tài khoản của bạn đã bị khóa!"]);
        $token = Str::random(40) . time();
        $reset = PasswordResetToken::where('email', $request->email)->first();
        if ($reset && now()->lessThan($reset->updated_at->addMinutes(10))) {
            return response()->json(['status' => 'warning', 'message' => 'Email khôi phục đã được gửi đi trước đó'], 200);
        } else if ($reset) {
            $user->resetToken()->update(['token' => $token]);
        } else {
            $user->resetToken()->create(['token' => $token, 'email' => $user->email]);
        }
        $username = $user->first_name . ' ' . $user->last_name;
        $this->sendMailReset($username, $token, $user->email);

        return response()->json(['status' => 'success', 'message' => 'Email khôi phục đã được gửi đi!'], 200);
    }
    public function resetPassword($token = null, $email = null)
    {
        $title = "Reset Password";
        if ($token && $email) {
            $user = User::where('email', $email)->first();
            $confirm = PasswordResetToken::where('email', $email)->where('token', $token)->first();
            if (!$user || !$confirm) {
                toastr()->warning('Thông tin không chính xác!');

                return redirect()->route('login');
            } else if (!now()->lessThan($confirm->updated_at->addMinutes(15))) {
                toastr()->warning('Email đã hết hạn!');

                return redirect()->route('forgot');
            }

            return view('Auth.resetPassword', compact('title', 'email', 'token'));
        } else {
            return redirect()->route('login');
        }
    }
    public function handleReset(Request $request)
    {
        $validator = $this->validatePassword($request);
        if($validator->fails()){
            return response()->json(['status' => 'validate', 'message' => $validator->errors()], 200);
        }
        $user = User::where('email', $request->email)->first();
        $confirm = PasswordResetToken::where('email', $request->email)->where('token', $request->token)->first();
        if($user && $confirm){
            $confirm->delete();
            $user->update(['password' => Hash::make($request->password)]);

            return response()->json(['status' => 'success', 'message' => 'Thay đổi mật khẩu thành công!'], 200);
        }else{
            return response()->json(['status' => 'error', 'message' => 'Đã có lỗi xảy ra!'], 200);
        }
    }
    public function validateEmail($request)
    {
        $rules = [
            'email' => ['required', 'email', 'exists:users,email'],
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
    public function validatePassword($request)
    {
        $rules = [
            'password' => ['required', 'min:8', 'max:40'],
            'repassword' => ['required', 'min:8', 'max:40', 'same:password']
        ];
        $messages = [
            'required' => ":attribute bắt buộc nhập",
            'min' => ":attribute tối thiểu :min ký tự",
            'max' => ":attribute tối đa :max ký tự",
            'same' => ":attribute không trùng khớp",
        ];
        $attributes = [
            'password' => 'Mật khẩu mới',
            'repassword' => 'Xác nhận mật khẩu mới',
        ];
        $validate = Validator::make($request->all(), $rules, $messages, $attributes);

        return $validate;
    }
    public function sendMailReset($user, $token, $email)
    {
        $url = route('password.reset', [$token, $email]);
        Mail::to($email)->send(new ResetPasswordMail($user, $url));
    }
}
