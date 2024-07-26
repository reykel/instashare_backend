<?php

namespace App\Http\Requests\Partida;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class PartidaUpdateRequest extends FormRequest
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
            'cantidad' => 'sometimes|required|max:255',
            'precio' => 'sometimes|required|max:255',
            'importe' => 'sometimes|required|max:255',
            'producto_id' => 'sometimes|required|integer',
            //'factura_id' => 'sometimes|required|integer',
            'oferta_id' => 'sometimes|required|integer',
        ];
    }
}
