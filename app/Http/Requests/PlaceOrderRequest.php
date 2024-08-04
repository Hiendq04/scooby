<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Propaganistas\LaravelPhone\Rules\Phone;

class PlaceOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|max:20',
            'last_name' => 'required|max:20',
            'shipping_address' => 'required',
            'phone' => ['required', new Phone('VN')],
            'email' => 'required|email',
            'note' => 'nullable|max:255',
            'payment_method' => 'required',
            'check' => 'accepted',
        ];
    }
    public function messages(): array
    {
        return [
            'required' => ':attribute không được để trống',
            'max' => ':attribute tối đa :max ký tự',
            'email' => 'Email không đúng định dang',
            'phone' => 'Số điện thoại không hợp lệ',
            'accepted' => ':attribute cần được xác nhận'
        ];
    }
    public function attributes(): array
    {
        return [
            'first_name' => 'Tên',
            'last_name' => 'Họ',
            'shipping_address' => 'Địa chỉ giao hàng',
            'phone' => 'Số điện thoại',
            'email' => 'Email',
            'note' => 'Ghi chú',
            'payment_method' => 'Phương thức thanh toán',
            'check' => 'Điều khoản và Điều kiện',
        ];
    }
}
