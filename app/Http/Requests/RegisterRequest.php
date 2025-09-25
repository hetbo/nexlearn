<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users',
            'mobile' => 'required|string|regex:/^09\d{9}$/|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:student,teacher',
        ];
    }

    public function messages(): array {

        return [
            'password.confirmed' => __('main.validation-password-confirm'),
            'mobile.regex' => __('main.validation-mobile'),
            'mobile.unique' => __('main.validation-unique'),
        ];

    }
}
