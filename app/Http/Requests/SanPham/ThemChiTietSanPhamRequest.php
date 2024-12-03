<?php

namespace App\Http\Requests\SanPham;

use Illuminate\Foundation\Http\FormRequest;

class ThemChiTietSanPhamRequest extends FormRequest
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
            'thuoc_tinh' => 'required',
            'gia' => 'required|gt:0',
            'so_luong' => 'required|gt:0',
        ];
    }

    public function messages(): array
    {
        return [
            'thuoc_tinh.required' => 'Thuộc tính không được để trống!',
            'gia.required' => 'Giá không được để trống!',
            'gia.gt' => 'Giá phải lớn hơn 0!',
            'so_luong.required' => 'Số lượng không được để trống!',
            'so_luong.gt' => 'Số lượng phải lớn hơn 0!',
        ];
    }
}
