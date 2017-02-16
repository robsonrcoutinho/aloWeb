@extends('main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default">
                    <ol class="breadcrumb panel-heading">
                        <li><a href="{{ route('users') }}">Usuarios</a></li>
                        <li class="active">Editar</li>
                    </ol>

                    <div class="form-horizontal">
                        {!! Form::open(['route'=>['users.alterar', $user->id], 'method'=>'put']) !!}
                        {{ csrf_field() }}
                        @if($errors->any())
                            <ul class="alert alert-warning">
                                @foreach(collect($errors->all())->unique() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        @endif

                        <div class="form-group">
                            {!! Form::hidden ('id', $user->id, ['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label ('name', 'Nome: ',['class'=>'control-label col-xs-2']) !!}
                            <div class="col-xs-5">
                                {!! Form::text('name', $user->name, ['class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label ('email', 'E-mail: ',['class'=>'control-label col-xs-2']) !!}
                            <div class="col-xs-5">
                                {!! Form::text('email', $user->email, ['class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label ('razao_social', 'Razao Social: ',['class'=>'control-label col-xs-2']) !!}
                            <div class="col-xs-5">
                                {!! Form::text('razao_social', $user->razao_social, ['class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label ('nome_fantasia', 'Nome Fantasia: ',['class'=>'control-label col-xs-2']) !!}
                            <div class="col-xs-5">
                                {!! Form::text('nome_fantasia', $user->nome_fantasia, ['class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label ('rua', 'Rua: ',['class'=>'control-label col-xs-2']) !!}
                            <div class="col-xs-5">
                                {!! Form::text('rua', $user->rua, ['class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label ('cidade', 'Cidade: ',['class'=>'control-label col-xs-2']) !!}
                            <div class="col-xs-5">
                                {!! Form::text('cidade', $user->cidade, ['class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label ('uf', 'UF: ',['class'=>'control-label col-xs-2']) !!}
                            <div class="col-xs-5">
                                {!! Form::text('uf', $user->uf, ['class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label ('cnpj_cpf', 'CNPJ/CPF: ',['class'=>'control-label col-xs-2']) !!}
                            <div class="col-xs-5">
                                {!! Form::text('cnpj_cpf', $user->cnpj_cpf, ['class'=>'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label ('telefone', 'Telefone: ',['class'=>'control-label col-xs-2']) !!}
                            <div class="col-xs-5">
                                {!! Form::text('telefone', $user->telefone, ['class'=>'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label ('password', 'Senha: ',['class'=>'control-label col-xs-2']) !!}
                            <div class="col-xs-5">
                                {!! Form::password('password', null, ['class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label ('password_confirmation', 'Confirmar senha: ',['class'=>'control-label col-xs-2']) !!}
                            <div class="col-xs-5">
                                {!! Form::password('password', null, ['class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-offset-2 col-xs-10">
                        {!! Form::submit ('Gravar', ['class'=>'btn btn-primary']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection