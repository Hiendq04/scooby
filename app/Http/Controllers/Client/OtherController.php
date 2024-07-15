<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;

class OtherController extends Controller
{
    public function about()
    {
        $title = "About Me";

        return view('Client.about', compact('title'));
    }
    public function contact()
    {
        $title = "Contact Us";
        $user = User::where('id', auth()->id())->first();

        return view('Client.contact', compact('title', 'user'));
    }
    public function sendQuestion(Request $request)
    {
        $data = [
            'user_id' => $request->user_id,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => now(),
        ];

        if (empty($data['subject']) || empty($data['message']))
            return response()->json(['type' => 'validate', 'message' => "Vui lòng nhập đầy đủ các trường thông tin!"], 200);

        if (Question::create($data))
            return response()->json(['type' => 'success', 'message' => 'Cảm ơn bạn đã đặt câu hỏi cho chúng tôi!', 'data' => $data], 200);

    }
    public function faq(){
        $title = "FAQ";

        return view('Client.faq', compact('title'));
    }
    public function gallery(){
        $title = "Gallery";

        return view('Client.gallery', compact('title'));
    }
}
