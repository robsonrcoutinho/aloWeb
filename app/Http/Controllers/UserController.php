<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\User;


class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('name')->get();      //Busca usu�rio ordenando pelo nome
        return view('user.index', compact('users'));//Abre p�gina inicial de usu�rios
    }

    public function novo()
    {
        return view('user.novo', ['roles' => config('constantes.roles')]);//Abre view de cadastro
    }

    public function salvar(UserRequest $request)
    {
        $this->validate($request,
            ['email' => 'unique:users,email']);                 //Valida e-mail de usu�rio
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'razao_social' => $request->razao_social,
            'nome_fantasia' => $request->nome_fantasia,
            'role' => $request->role,
            'rua' => $request->rua,
            'cidade' => $request->cidade,
            'uf' => $request->uf,
            'cnpj_cpf' => $request->cnpj_cpf,
            'telefone' => $request->telefone,
        ]);                                                 //Cria usu�rio a partir de dados do request
        return redirect('users');                           //Redireciona para rota inicial de usu�rios
    }

    public function editar($id)
    {
        $user = User::find($id);                                //Busca usu�rio kpelo id
        $roles = config('constantes.roles');                    //Pega rela��o de roles
        return view('user.editar', compact('user', 'roles'));   //Abre view de edi��o
    }

    public function alterar(UserRequest $request, $id)
    {
        $this->validate($request,
            ['email' => 'unique:users,email,' . $id]);          //Valida e-mail de usu�rio
        $user = User::find($id);                                //Busca usu�rio pelo id
        $user->fill($request->all());                           //Passa dados vindos do request
        $user->password = bcrypt($request->password);           //Passa senha criptografada
        $user->save();                                          //Salva altera��o
        return redirect('users');                               //Redireciona para rota inicial de usu�rio
    }

    public function excluir($id)
    {
        User::find($id)->delete();  //Consulta usu�rio pelo id e exclui
        return redirect('users');   //Redireciona para rota inicial de usu�rio
    }
}
