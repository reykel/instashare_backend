<?php

namespace App\Http\Requests\ApiAuthentication;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OfertaSetLinkRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            //'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ];
    }
}
