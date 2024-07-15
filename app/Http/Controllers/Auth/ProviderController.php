<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class ProviderController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    public function callback($provider)
    {
        $socialUser = Socialite::driver($provider)->user();

        if (!$socialUser) {
            toastr()->error("Không thể lấy dữ liệu từ nhà cung cấp xã hội!");
            return redirect()->route('login');
        }

        $email = $socialUser->getEmail();

        $existingUser = User::where('email', $email)->first();

        if ($existingUser) {
            if ($existingUser->provider !== $provider) {
                toastr()->warning("Email đã được đăng nhập bằng phương thức khác!");
                return redirect()->route('login');
            } else {
                Auth::login($existingUser);
                toastr()->success("Đăng nhập thành công!");
                return redirect()->route('/');
            }
        }

        $user = User::create([
            'provider' => $provider,
            'provider_id' => $socialUser->id,
            'avatar' => $socialUser->avatar,
            'email' => $email,
            'first_name' => $socialUser->getName() ?: $socialUser->getNickname(),
            'provider_token' => $socialUser->token,
            'email_verified_at' => now(),
            'status' => 'active',
        ]);

        Auth::login($user);
        if (Auth::check()) {
            toastr()->success("Đăng nhập thành công!");
            return redirect()->route('/');
        }
    }
}
