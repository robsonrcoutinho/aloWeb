<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstoqueRequest extends FormRequest
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
            'fk_id_produto' => 'required',
            'quantidade'=>'required|integer|min:0'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Precisa informar campo :attribute',
            'min'=>'Valor minimo para campo :attribute deve ser :min'
        ];
    }

    public function attributes()
    {
        return [
            'fk_id_produto' => 'produto'
        ];
    }
}
