<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriaRequest extends FormRequest
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
            'nome_categoria'=>'required|min:3|max:30'
        ];
    }

    public function messages()
    {
        return [
            'nome_categoria.required'=>'O campo categoria é obrigatório',
            'nome_categoria.min'=>'O campo categoria deve ser maior que 3',
            'nome_categoria.max'=>'O campo categoria deve ser menor que 30',
        ];
    }
}
