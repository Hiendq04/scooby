<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Carbon\Carbon;


class VoucherController extends Controller
{
    public function apply(Request $request)
    {
        $voucher = Voucher::where('code', $request->voucher)->first();
        if (!$voucher) {
            return response()->json(['type' => 'error', 'message' => 'Mã giảm giá không tồn tại!']);
        }

        $currentDateTime = Carbon::now();
        $startDateTime = Carbon::parse($voucher->start_date);
        $endDateTime = Carbon::parse($voucher->end_date);

        if ($startDateTime > $currentDateTime || $endDateTime < $currentDateTime || $voucher->status !== 'active') {
            return response()->json(['type' => 'warning', 'message' => "Mã giảm giá không khả dụng!"]);
        }

        if ($voucher->condition > $request->total) {
            return response()->json(['type' => 'warning', 'message' => 'Tổng giá chưa đạt điều kiện giá tối thiểu của mã giảm giá!']);
        }

        return response()->json(['type' => 'success', 'message' => "Đã áp dụng mã giảm giá thành công!", 'value' => $voucher->value]);


    }
}
