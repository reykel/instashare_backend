<?php

namespace App\Http\Requests\Authorized;

use Illuminate\Foundation\Http\FormRequest;

class AuthorizedStoreRequest extends FormRequest
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
            'name' => 'required|max:255',
            'carnet_identidad' => 'required|max:255',
        ];
    }
}
