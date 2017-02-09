<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoRequest extends FormRequest
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
            'nome_produto'=>'required|min:3|max:70',
            'valor'=>'required|numeric|between:0,99.99',
            'fk_id_categoria'=>'required',
            'fk_id_marca'=>'required',
            'imagem'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'nome_produto.required'=>'O campo Nome Produto é obrigatório',
            'valor.numeric'=>'Precisa ser número, não coloque virgula, coloque ponto',
            'valor.required'=>'O campo Valor é obrigatório',
            'fk_id_categoria.required'=>'Escolha categoria',
            'fk_id_marca.required'=>'Escolha marca',
            'imagem.required'=>'Selecione uma imagem'
        ];
    }
}
