<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCauthuRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'   => 'required|string|min:3|max:255',
            'age'    => 'required|integer|min:1|max:60',
            'salary' => 'required|numeric|min:0',
            'image'  => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'   => 'Tên cầu thủ không được để trống',
            'age.required'    => 'Tuổi không được để trống',
            'age.integer'     => 'Tuổi phải là số nguyên',
            'salary.required'=> 'Lương không được để trống',
            'salary.numeric' => 'Lương phải là số',
            'image.image'    => 'File phải là hình ảnh',
            'image.max'      => 'Hình ảnh không được vượt quá 1MB',
        ];
    }
}
