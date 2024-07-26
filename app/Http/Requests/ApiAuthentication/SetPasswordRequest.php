<?php

namespace App\Http\Requests\ApiAuthentication;

use Illuminate\Validation\Rules\Password;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class SetPasswordRequest extends FormRequest
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
            'token' => 'required',
            'email' => 'required|email',
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

    public function getCurrentUser()
    {

        $token = $this->get('token');

        $passwordResets = DB::table('password_resets')->where('token', $token)->first();

        $this->validateToken($passwordResets);

        $user = User::firstWhere('email', $passwordResets->email);

        $this->validateUser($user);

        return $user;

    }

    private function validateToken($passwordResets)
    {
        if(! $passwordResets) {
            throw ValidationException::withMessages([
                'token' => 'invalid token',
            ]);
        }

        if(Carbon::createFromTimeString($passwordResets->created_at)->diffInMinutes(now()) >= 60) {
            throw ValidationException::withMessages([
                'token' => 'expired token',
            ]);
        }
    }

    private function validateUser(User $user)
    {
        if(! $user) {
            throw ValidationException::withMessages([
                'email' => 'User does not exists',
            ]);
        }

        if($this->get('email') !== $user->email) {
            throw ValidationException::withMessages([
                'email' => 'Invalid email',
            ]);
        }
    }
}
