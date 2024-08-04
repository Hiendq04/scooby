<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'price' => 'required|numeric|digits_between:1,10',
            'price_sale' => 'required|numeric|digits_between:1,10|lt:price',
            'quantity' => 'required|numeric|digits_between:1,10|min:1',
            'status' => 'required',
            'category_id' => 'required',
            'name' => 'required|max:255',
            'sku' => 'required|max:255',
            'description' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'required' => ':attribute không được để trống',
            'numeric' => ':attribute phải là số',
            'digits_between' => ':attribute phải có độ dài nằm trong khoảng :min đến :max chữ số',
            'lt' => [
                'numeric' => ':attribute phải nhỏ hơn giá gốc',
            ],
            'min' => [
                'numeric' => ':attribute phải lớn hơn hoặc bằng :min',
            ],
            'max' => ':attribute tối đa :max kí tự',
            'unique' => ':attribute đã tồn tại',
        ];
    }
    public function attributes(): array
    {
        return [
            'price' => 'Giá gốc',
            'price_sale' => 'Giá khuyến mãi',
            'quantity' => 'Số lượng',
            'status' => 'Trạng thái',
            'category_id' => 'Danh mục',
            'name' => 'Tên sản phẩm',
            'sku' => 'Mã sản phẩm',
            'description' => 'Mô tả',
        ];
    }
}
