<?php

namespace App\Http\Requests\SanPham;

use Illuminate\Foundation\Http\FormRequest;

class SuaSanPhamRequest extends FormRequest
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
            'ten_san_pham' => 'required',
            'hinh_anh' => 'nullable',
            'chiTietSanPham.*.thuoc_tinh' => 'required',
            'chiTietSanPham.*.gia' => 'required|gt:0',
            'chiTietSanPham.*.so_luong' => 'required|gt:0',
        ];
    }

    public function messages(): array
    {
        return [
            'ten_san_pham.required' => 'Tên sản phẩm không được để trống!',
            'chiTiet.*.thuoc_tinh.required' => 'Thuộc tính không được để trống!',
            'chiTiet.*.gia.required' => 'Giá không được để trống!',
            'chiTiet.*.gia.required' => 'Giá phải lớn hơn 0!',
            'chiTiet.*.so_luong.required' => 'Số lượng không được để trống!',
            'chiTiet.*.so_luong.gt' => 'Số lượng phải lớn hơn 0!',
        ];
    }
}
