<?php

namespace App\Http\Requests\Partida;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class PartidaStoreRequest extends FormRequest
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
            'cantidad' => 'required|max:255',
            'precio' => 'required|max:255',
            'importe' => 'required|max:255',
            'producto_id' => 'required|integer',
            //'factura_id' => 'required|integer',
            'oferta_id' => 'required|integer',
        ];
    }
}

