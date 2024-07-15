<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function list()
    {
        $title = 'Voucher';

        return view('Admin.voucher_list', compact('title'));
    }
    public function add()
    {
        $title = 'Voucher';

        return view('Admin.voucher_add', compact('title'));
    }
    public function edit(Request $request)
    {
        $title = 'Voucher';
        $voucher = Voucher::find($request->id);
        if(!$voucher)
            return redirect()->route('admin.voucher.list');

        return view('Admin.voucher_edit', compact('title', 'voucher'));
    }
    public function getVouchers(Request $request)
    {
        $keyword = $request->keyword;
        $perPage = $request->count;

        $vouchers = Voucher::select('id', 'code', 'limit', 'value', 'condition', 'type', 'start_date', 'end_date', 'status')
            ->orderBy('id', 'desc');

        if (!empty($keyword)) {
            $vouchers->where('code', 'LIKE', '%' . $keyword . '%');
        }

        $vouchers = $vouchers->paginate($perPage);

        $vouchers->getCollection()->transform(function ($voucher) {
            $startDate = $voucher->start_date instanceof \Carbon\Carbon ? $voucher->start_date->format('d/m/Y') : null;
            $endDate = $voucher->end_date instanceof \Carbon\Carbon ? $voucher->end_date->format('d/m/Y') : null;

            return [
                'id' => $voucher->id,
                'code' => strtoupper($voucher->code),
                'start_date' => $startDate,
                'end_date' => $endDate,
                'limit' => $voucher->limit,
                'type' => $voucher->type,
                'status' => $voucher->status,
                'value' => $voucher->value,
                'condition' => number_format($voucher->condition, 0, ',', ','),
            ];
        });

        return response()->json($vouchers, 200);
    }
    public function deleteVoucher(Request $request)
    {
        $voucher = Voucher::find($request->id);
        $voucher->delete();

        return response()->json(['type' => 'success', 'data' => "Đã xóa thành công!"], 200);
    }
    public function handleAddVoucher(Request $request)
    {
        if (!$request->status || !$request->type || !$request->code || !$request->start_date || !$request->end_date || !$request->limit || !$request->value)
            return response()->json(['type' => 'warning', 'data' => 'Vui lòng nhập đầy đủ thông tin!']);

        $currentDate = Carbon::now()->toDateString();
        if ($request->start_date < $currentDate)
            return response()->json(['type' => 'warning', 'data' => 'Ngày bắt đầu phải từ ngày hôm nay trở đi!']);

        if ($request->end_date < $request->start_date)
            return response()->json(['type' => 'warning', 'data' => 'Ngày kết thúc phải lớn hơn ngày bắt đầu!']);
        if (Voucher::where('code', $request->code)->exists())
            return response()->json(['type' => 'warning', 'data' => 'Mã giảm giá đã tồn tại!']);

        $validate = [];
        if (!$this->isValidString($request->code))
            $validate['code'] = 'Code không hợp lệ!';
        if ($request->condition < 0)
            $validate['condition'] = 'Điều kiện áp dụng không được nhỏ hơn 0!';
        if ($request->limit <= 0)
            $validate['limit'] = 'Số lượng cần lớn hơn 0!';
        if ($request->value <= 0)
            $validate['value'] = 'Giá trị cần lớn hơn 0!';
        if ($request->type == 'percentage' && $request->value > 100)
            $validate['value'] = 'Giá trị không được lớn hơn 100%!';


        if (!empty($validate))
            return response()->json(['type' => 'validate', 'data' => $validate]);

        Voucher::create([
            'code' => strtoupper($request->code),
            'status' => $request->status,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'condition' => ($request->condition) ? $request->condition : '0',
            'limit' => $request->limit,
            'value' => $request->value,
            'type' => $request->type,
        ]);

        return response()->json(['type' => 'success', 'data' => 'Thêm mới mã giảm giá thành công!']);
    }
    public function updateVoucher(Request $request)
    {
        $voucher = Voucher::find($request->idVoucher);

        if (!$request->status || !$request->type || !$request->start_date || !$request->end_date || !$request->limit || !$request->value)
            return response()->json(['type' => 'warning', 'data' => 'Vui lòng nhập đầy đủ thông tin!']);

        $currentDate = Carbon::now()->toDateString();
        if ($request->start_date < $currentDate)
            return response()->json(['type' => 'warning', 'data' => 'Ngày bắt đầu phải từ ngày hôm nay trở đi!']);

        if ($request->end_date < $request->start_date)
            return response()->json(['type' => 'warning', 'data' => 'Ngày kết thúc phải lớn hơn ngày bắt đầu!']);

        $validate = [];
        if ($request->condition < 0)
            $validate['condition'] = 'Điều kiện áp dụng không được nhỏ hơn 0!';
        if ($request->limit <= 0)
            $validate['limit'] = 'Số lượng cần lớn hơn 0!';
        if ($request->value <= 0)
            $validate['value'] = 'Giá trị cần lớn hơn 0!';
        if ($request->type == 'percentage' && $request->value > 100)
            $validate['value'] = 'Giá trị không được lớn hơn 100%!';


        if (!empty($validate))
            return response()->json(['type' => 'validate', 'data' => $validate]);

        $voucher->update([
            'status' => $request->status,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'condition' => ($request->condition) ? $request->condition : '0',
            'limit' => $request->limit,
            'value' => $request->value,
            'type' => $request->type,
        ]);

        return response()->json(['type' => 'success', 'data' => 'Cập nhật mã giảm giá thành công!']);
    }
    private function isValidString($string)
    {
        $pattern = '/^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z\d]{10}$/';

        return preg_match($pattern, $string) === 1;
    }
}
