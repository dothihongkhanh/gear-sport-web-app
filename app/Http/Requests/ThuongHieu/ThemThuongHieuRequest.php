<?php

namespace App\Http\Requests\ThuongHieu;

use Illuminate\Foundation\Http\FormRequest;

class ThemThuongHieuRequest extends FormRequest
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
            'ten_thuong_hieu' => 'required|unique:thuong_hieu,ten_thuong_hieu'
        ];
    }

    public function messages(): array
    {
        return [
            'ten_thuong_hieu.required' => 'Tên thương hiệu không được để trống!',
            'ten_thuong_hieu.unique' => 'Tên thương hiệu đã có!',
        ];
    }
}
