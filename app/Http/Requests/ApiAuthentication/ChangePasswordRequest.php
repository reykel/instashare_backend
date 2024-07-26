<?php

namespace App\Http\Requests\ApiAuthentication;

use Illuminate\Validation\Rules\Password;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ChangePasswordRequest extends FormRequest
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
            'old_password' => 'required',
            'password' => [
                'required',
                'string',
                'confirmed',
                'different:old_password',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})/',
            ],
            'password_confirmation' => 'required|same:password',
        ];
    }

    public function messages(): array
    {
        return [
            'old_password.required' => 'The current password is required',
            'password.required' => 'A new passowrd is required. Your password must be more than 8 characters long, should contain at-least 1 Uppercase, 1 Lowercase and 1 Numeric character.',
            'password.different' => 'New password can not be identical to current password.  Your password must be more than 8 characters long, should contain at-least 1 Uppercase, 1 Lowercase and 1 Numeric character.',
            'password.regex' => 'New password is not valid. Your password must be more than 8 characters long, should contain at-least 1 Uppercase, 1 Lowercase and 1 Numeric character.',
            'password_confirmation.required' => 'A passowrd confirmation is required.',
            'password.same' => 'Password confirmation needs to match new password selection.',
        ];
    }

}
