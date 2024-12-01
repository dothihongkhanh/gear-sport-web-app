<?php

namespace App\Http\Requests\ThuongHieu;

use Illuminate\Foundation\Http\FormRequest;

class SuaThuongHieuRequest extends FormRequest
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
        $ma_thuong_hieu = $this->route('ma_thuong_hieu');

        return [
            'sua_ten_thuong_hieu' => 'required|unique:thuong_hieu,ten_thuong_hieu,' . $ma_thuong_hieu . ',ma_thuong_hieu',
        ];
    }

    public function messages(): array
    {
        return [
            'sua_ten_thuong_hieu.required' => 'Tên danh mục không được để trống!',
            'sua_ten_thuong_hieu.unique' => 'Tên danh mục đã có!',
        ];
    }
}
