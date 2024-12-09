<?php

namespace App\Http\Requests\SanPham;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class ThemSanPhamRequest extends FormRequest
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
    public function rules()
    {
        $tabSelected = $this->get('tab_selected', 'hasDetailsContent');

        $commonRules = [
            'ten_san_pham' => 'required|string|max:255',
            'mo_ta' => 'nullable|string',
            'hinh_anh' => 'required|image',
        ];

        if ($tabSelected === 'hasDetailsContent') {
            $detailRules = [
                'chiTietSanPham' => 'required|array|min:1',
                'chiTietSanPham.*.thuoc_tinh' => 'required|string|max:255',
                'chiTietSanPham.*.gia' => 'required|numeric|min:0',
                'chiTietSanPham.*.so_luong' => 'required|integer|min:0',
                'chiTietSanPham.*.hinh_anh_chi_tiet' => 'nullable|image',
            ];
            return array_merge($commonRules, $detailRules);
        } else {
            $noDetailRules = [
                'gia' => 'required|numeric|min:0',
                'so_luong' => 'required|integer|min:0',
            ];
            return array_merge($commonRules, $noDetailRules);
        }
    }

    /**
     * Get the validation messages.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'ten_san_pham.required' => 'Tên sản phẩm không được để trống.',
            'hinh_anh.required' => 'Hình ảnh sản phẩm không được để trống.',
            'chiTietSanPham.*.thuoc_tinh.required' => 'Thuộc tính sản phẩm là bắt buộc.',
            'chiTietSanPham.*.gia.required' => 'Giá sản phẩm là bắt buộc.',
            'chiTietSanPham.*.so_luong.required' => 'Số lượng sản phẩm là bắt buộc.',
            'chiTietSanPham.*.hinh_anh_chi_tiet.image' => 'Hình ảnh chi tiết phải là một file ảnh.',
            'gia.required' => 'Giá sản phẩm là bắt buộc.',
            'so_luong.required' => 'Số lượng sản phẩm là bắt buộc.',
        ];
    }
}
