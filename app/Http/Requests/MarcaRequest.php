<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MarcaRequest extends FormRequest
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
            'marca'=>'required|min:3|max:25'
        ];
    }

    public function messages()
    {
        return [
            'marca.required'=>'O campo marca é obrigatório',
            'marca.min'=>'O campo marca deve ser maior que 3',
            'marca.max'=>'O campo marca deve ser menor que 25',
        ];
    }
}
