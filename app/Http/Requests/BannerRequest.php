<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
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
            'title' => 'required|min:5|max:255',
            'content' => 'required|min:5|max:255',
            'image' => 'required',
            'status' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'required' => ':attribute không được để trống',
            'min' => ':attribute tối thiểu :min ký tự',
            'max' => ':attribute tối thiểu :max ký tự',
        ];
    }
    public function attributes(): array
    {
        return [
            'title' => 'Tiêu đề',
            'content' => 'Nội dung',
            'image' => 'Ảnh',
            'status' => 'Trạng thái',
        ];
    }
}
