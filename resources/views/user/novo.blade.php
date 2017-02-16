@extends('main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <ol class="breadcrumb panel-heading">
                        <li><a href="{{ route('users') }}">Usuarios</a></li>
                        <li class="active">Novo</li>
                    </ol>
                    <div class="form-horizontal">
                        <form action="{{ route('users.salvar')}}" method="post">
                            {{ csrf_field() }}
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    @foreach(collect($errors->all())->unique() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </div>
                            @endif
                            <div class="form-group">
                                {!! Form::label ('name', 'Nome: ',['class'=>'control-label col-xs-2']) !!}
                                <div class="col-xs-5">
                                    {!! Form::text('name', old('name'), ['class'=>'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label ('email', 'E-mail: ',['class'=>'control-label col-xs-2']) !!}
                                <div class="col-xs-5">
                                    {!! Form::text('email', old('email'), ['class'=>'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label ('razao_social', 'Razao Social: ',['class'=>'control-label col-xs-2']) !!}
                                <div class="col-xs-5">
                                    {!! Form::text('razao_social', old('razao_social'), ['class'=>'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label ('nome_fantasia', 'Nome Fantasia: ',['class'=>'control-label col-xs-2']) !!}
                                <div class="col-xs-5">
                                    {!! Form::text('nome_fantasia', old('nome_fantasia'), ['class'=>'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label ('rua', 'Rua: ',['class'=>'control-label col-xs-2']) !!}
                                <div class="col-xs-5">
                                    {!! Form::text('rua', old('rua'), ['class'=>'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label ('cidade', 'Cidade: ',['class'=>'control-label col-xs-2']) !!}
                                <div class="col-xs-5">
                                    {!! Form::text('cidade', old('cidade'), ['class'=>'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label ('uf', 'UF: ',['class'=>'control-label col-xs-2']) !!}
                                <div class="col-xs-5">
                                    {!! Form::text('uf', old('uf'), ['class'=>'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label ('cnpj_cpf', 'CNPJ/CPF: ',['class'=>'control-label col-xs-2']) !!}
                                <div class="col-xs-5">
                                    {!! Form::text('cnpj_cpf', old('cnpj_cpf'), ['class'=>'form-control']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label ('telefone', 'Telefone: ',['class'=>'control-label col-xs-2']) !!}
                                <div class="col-xs-5">
                                    {!! Form::text('telefone', old('telefone'), ['class'=>'form-control']) !!}
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
                            <button class="btn btn-primary">Salvar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection