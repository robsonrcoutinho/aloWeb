@extends('main')
@section('content')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default panel-table">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col col-xs-6">
                                <h3 class="panel-title">Listagem de Usuarios</h3>
                            </div>
                            <div class="col col-xs-6 text-right">
                                @can('salvar', App\User::class)
                                <a href="{{ route('users.novo')}}" class="btn btn-sm btn-primary btn-create">Criar novo</a>
                                @endcan
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped table-bordered table-list">
                            <thead>
                            <tr>
                                <th><em class="fa"></em></th>
                                <th>Usuário</th>
                                <th>E-mail</th>
                                <th>Empresa</th>
                                <th>Papel</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td align="center">
                                        @can('alterar', App\User::class)
                                        <a href="{{route('users.editar',['id'=>$user->id])}}" class="btn btn-default"><em class="fa fa-pencil"></em></a>
                                        @endcan
                                        @can('excluir', App\User::class)
                                        <a href="{{route('users.excluir',['id'=>$user->id])}}" class="btn btn-danger"><em class="fa fa-trash"></em></a>
                                        @endcan
                                    </td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->nome_fantasia}}</td>
                                    <td>{{$user->role}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div></div></div>
@endsection