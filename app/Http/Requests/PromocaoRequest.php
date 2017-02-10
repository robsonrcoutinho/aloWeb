<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PromocaoRequest extends FormRequest
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
            'titulo' => 'required|min:3|max:70',
            'valor' => 'required|numeric|between:0,9999.99',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Precisa informar campo :attribute',
            'numeric' => 'Campo :attribute precisa ser numerico',
            'between'=> 'Campo :attribute deve estar entre :min e :max',
            'min'=>'Campo :attribute deve ter pelo menos :min caracteres',
            'max'=>'Campo :attribute pode ter no maximo :max caracteres'
        ];
    }
}