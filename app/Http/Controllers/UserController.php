<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\User;


class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('name')->get();      //Busca usuário ordenando pelo nome
        return view('user.index', compact('users'));//Abre página inicial de usuários
    }

    public function novo()
    {
        return view('user.novo', ['roles' => config('constantes.roles')]);//Abre view de cadastro
    }

    public function salvar(UserRequest $request)
    {
        $this->validate($request,
            ['email' => 'unique:users,email']);                 //Valida e-mail de usuário
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
        ]);                                                 //Cria usuário a partir de dados do request
        return redirect('users');                           //Redireciona para rota inicial de usuários
    }

    public function editar($id)
    {
        $user = User::find($id);                                //Busca usuário kpelo id
        $roles = config('constantes.roles');                    //Pega relação de roles
        return view('user.editar', compact('user', 'roles'));   //Abre view de edição
    }

    public function alterar(UserRequest $request, $id)
    {
        $this->validate($request,
            ['email' => 'unique:users,email,' . $id]);          //Valida e-mail de usuário
        $user = User::find($id);                                //Busca usuário pelo id
        $user->fill($request->all());                           //Passa dados vindos do request
        $user->password = bcrypt($request->password);           //Passa senha criptografada
        $user->save();                                          //Salva alteração
        return redirect('users');                               //Redireciona para rota inicial de usuário
    }

    public function excluir($id)
    {
        User::find($id)->delete();  //Consulta usuário pelo id e exclui
        return redirect('users');   //Redireciona para rota inicial de usuário
    }
}
