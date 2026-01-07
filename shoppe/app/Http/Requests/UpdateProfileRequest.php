<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // username: bắt buộc
            'name' => 'required|string|max:255',

            // email: bắt buộc nhưng KHÔNG update
            'email' => 'required|email',

            // password: không bắt buộc
            'password' => 'nullable|min:6',

            // các field khác không bắt buộc
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'id_country' => 'nullable|integer',

            // avatar: image < 1MB
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
        ];
    }
}
