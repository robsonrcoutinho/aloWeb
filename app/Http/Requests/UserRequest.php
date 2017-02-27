<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'email' => 'required|email|max:255',
            'role'=>'required',
            'password' => 'required|min:6|confirmed',
            'razao_social'=>'required|max:70',
            'nome_fantasia'=>'required|max:30',
            'rua'=>'required|max:25',
            'cidade'=>'required|max:25',
            'uf'=>'required|size:2|alpha',
            'telefone'=>'required|digits_between:8,14|numeric',
            'cnpj_cpf'=>'required|digits_between:11,14|numeric'
        ];
    }
}
