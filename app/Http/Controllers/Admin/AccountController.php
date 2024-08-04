<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public function list()
    {
        $title = "Accounts";
        $idUser = auth()->id();

        return view('Admin.accounts.account_list', compact('title', 'idUser'));
    }
    public function getAccounts(Request $request)
    {
        $keyword = $request->keyword;
        $perPage = $request->count;

        $accounts = User::select('id', 'first_name', 'last_name', 'created_at', 'email', 'role', 'status')
            ->orderBy('id', 'desc');

        if (!empty($keyword)) {
            $accounts->where(function ($query) use ($keyword) {
                $query->where('first_name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $keyword . '%');
            });
        }

        $accounts = $accounts->paginate($perPage);

        $accounts->getCollection()->transform(function ($account) {
            return [
                'id' => $account->id,
                'name' => $account->first_name . ' ' . $account->last_name,
                'register_date' => $account->created_at->format('d/m/Y'),
                'email' => $account->email,
                'total_order' => '0',
                'role' => $account->role,
                'status' => $account->status,
            ];
        });

        return response()->json($accounts, 200);
    }
    public function addAccount(Request $request)
    {
        $validator = $this->validateAccount($request->all());
        if ($validator->fails()) {
            return response()->json(["type" => "validate", "data" => $validator->errors()], 200);
        }

        $newData = [
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "role" => $request->role,
            "status" => $request->status,
            "avatar" => $request->avatar,
            "email_verified_at" => now(),
        ];
        User::create($newData);
        return response()->json(["type" => "success", "data" => "Thêm mới tài khoản thành công!"], 200);
    }
    public function deleteAccount(Request $request)
    {
        if ($request->id == $request->idUser)
            return response()->json(['type' => "error", "data" => "Bạn không thể xóa tài khoản của mình!"], 200);

        $account = User::find($request->id);
        $user = User::find($request->idUser);
        if (($account->first_name == 'admin') || ($account->role == 'admin' && $user->first_name !== 'admin'))
            return response()->json(['type' => "error", "data" => "Bạn không thể xóa người dùng này!"], 200);

        $account->delete();
        return response()->json(["type" => "success", "data" => "Xóa người dùng thành công!"], 200);
    }
    public function editAccount(Request $request)
    {
        $account = User::where('id', $request->idAccount)->first();
        return response()->json($account, 200);
    }
    public function updateAccount(Request $request)
    {
        $account = User::where('id', $request->idAccount)->first();
        if ($account->role != 'admin' || ($account->role == 'admin' && $request->idUser == 1) || $request->idAccount == $request->idUser) {
            $data = $request->except('idAccount', 'idUser');

            if ($account->email == $request->email && !$request->password) {
                $data['email'] = 'hople@hople.hople';
                $data['password'] = 'password';
            } else if ($account->email == $request->email) {
                $data['email'] = 'hople@hople.hople';
            } else if (!$request->password) {
                $data['password'] = 'password';
            } else {
                $data['email'] = $request->email;
            }

            $validator = $this->validateAccount($data);
            if ($validator->fails()) {
                return response()->json(['type' => "validate", 'data' => $validator->errors()], 200);
            }

            $data['email'] = $request->email;

            if (!$request->password) {
                $updated = User::where('id', $request->idAccount)->update([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'avatar' => $request->avatar,
                    'role' => $request->role,
                    'status' => $request->status,
                ]);
            } else {
                $data['password'] = Hash::make($request->password);
                $updated = User::where('id', $request->idAccount)->update($data);
            }

            if ($updated)
                return response()->json(['type' => 'success', 'data' => 'Cập nhật thành công!']);
            return response()->json(['type' => 'error', 'data' => "Đã có lỗi xảy ra! Vui lòng thử lại sau!"]);
        }else{
            return response()->json(['type' => 'warning', 'data' => 'Bạn không thể chỉnh sửa tài khoản này!']);
        }
    }
    public function validateAccount($request)
    {
        $rules = [
            "first_name" => ["required", "max: 20"],
            "last_name" => ["required", "max: 20"],
            "email" => ["required", "max: 255", "email", 'unique:users'],
            'password' => ['required', 'min:8', 'max:40'],
        ];
        $messages = [
            "required" => ":attribute bắt buộc nhập",
            "min" => ":attribute tối thiểu :min ký tự",
            "max" => ":attribute tối đa :max ký tự",
            "email" => "Email không đúng định dạng",
            "unique" => "Email đã tồn tại",
        ];
        $attributes = [
            "first_name" => "Tên",
            "last_name" => "Họ",
            "email" => "Email",
            "password" => "Mật khẩu"
        ];

        $validate = Validator::make($request, $rules, $messages, $attributes);

        return $validate;
    }
    public function showAccount(Request $request){
        $title = "Account Detail";
        $account = User::find($request->id);
        $profile = Profile::where('user_id', $request->id)->first();

        return view('Admin.accounts.account_detail', compact('title', 'account', 'profile'));
    }
}
