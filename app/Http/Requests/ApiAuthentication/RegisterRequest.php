<?php

namespace App\Http\Requests\ApiAuthentication;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                'string',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})/',
            ],
            'password_confirmation' => 'required|same:password',
        ];
    }

    public function messages(): array
    {
        return [
            'password.required' => 'A new passowrd is required. Your password must be more than 8 characters long, should contain at-least 1 Uppercase, 1 Lowercase and 1 Numeric character.',
            'password.regex' => 'New password is not valid. Your password must be more than 8 characters long, should contain at-least 1 Uppercase, 1 Lowercase and 1 Numeric character.',
            'password_confirmation.required' => 'A passowrd confirmation is required.',
            'password.same' => 'Password confirmation needs to match new password selection.',
        ];
    }
}
