<?php

namespace App\Http\Requests\DonHang;

use Illuminate\Foundation\Http\FormRequest;

class ThemDonHangRequest extends FormRequest
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
            'ten_nguoi_nhan' => 'required',
            'sdt_nhan_hang' => 'required',
            'dia_chi_nhan_hang' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'ten_nguoi_nhan.required' => 'Tên người nhận không được để trống!',
            'sdt_nhan_hang.required' => 'Số điện thoại không được để trống!',
            'dia_chi_nhan_hang.required' => 'Địa chỉ không được để trống!',
        ];
    }
}
