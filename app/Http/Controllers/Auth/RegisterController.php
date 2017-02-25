<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'razao_social'=>'required|max:70',
            'nome_fantasia'=>'required|max:30',
            'rua'=>'required|max:25',
            'cidade'=>'required|max:25',
            'uf'=>'required|size:2|alpha',
            'telefone'=>'required|digits_between:8,14|numeric',
            'cnpj_cpf'=>'required|digits_between:11,14|numeric'
        ],[
            'alpha'=>'Campo :attribute deve ter apenas letras',
            'between'=>'Campo :attribute deve ter entre :min e :max caracteres',
            'confirmed'=>'Campo :attribute precisa ser confirmado',
            'digits_between'=>'Campo :attribute deve ter entre :min e :max algarismos',
            'email' => 'Campo :attribute deve ter um email valido',
            'max'=>'Campo :attribute pode ter no maximo :max caracteres',
            'min'=>'Campo :attribute deve ter no minimo :min caracteres',
            'numeric'=>'Campo :attribute deve ter apenas algarismos',
            'required'=>'Campo :attribute precisa ser informado',
            'size'=>'Campo :attribute deve ter :size caracteres',
        ],[
            'name'=>'nome',
            'password'=>'senha',
            'razao_social'=>'Razao Social',
            'nome_fantasia'=>'Nome Fantasia',
            'cnpj_cpf'=>'CNPJ/CPF'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'razao_social' => $data['razao_social'],
            'nome_fantasia' => $data['nome_fantasia'],
            'rua' => $data['rua'],
            'cidade' => $data['cidade'],
            'uf' => $data['uf'],
            'cnpj_cpf' => $data['cnpj_cpf'],
            'telefone' => $data['telefone'],
        ]);
    }
}
