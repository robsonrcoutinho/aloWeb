<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\User;


class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('name')->get();
        return view('user.index', compact('users'));
    }

    public function novo()
    {
        return view('user.novo');
    }

    public function salvar(UserRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'razao_social' => $request->razao_social,
            'nome_fantasia' => $request->nome_fantasia,
            'rua' => $request->rua,
            'cidade' => $request->cidade,
            'uf' => $request->uf,
            'cnpj_cpf' => $request->cnpj_cpf,
            'telefone' => $request->telefone,
        ]);
        return redirect('users');
    }

    public function editar($id)
    {
        $user = User::find($id);
        return view('user.editar', compact('user'));
    }

    public function alterar(UserRequest $request, $id)
    {
        User::find($id)->update($request->all());
        return redirect('users');
    }

    public function excluir($id)
    {
        User::find($id)->delete();
        return redirect('users');
    }
}
