<?php

namespace App\Http\Requests\DanhMuc;

use Illuminate\Foundation\Http\FormRequest;

class SuaDanhMucRequest extends FormRequest
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
        $ma_danh_muc = $this->route('ma_danh_muc');

        return [
            'sua_ten_danh_muc' => 'required|unique:danh_muc,ten_danh_muc,' . $ma_danh_muc . ',ma_danh_muc',
        ];
    }

    public function messages(): array
    {
        return [
            'sua_ten_danh_muc.required' => 'Tên danh mục không được để trống!',
            'sua_ten_danh_muc.unique' => 'Tên danh mục đã có!',
        ];
    }
}
